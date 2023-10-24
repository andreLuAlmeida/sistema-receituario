<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Medico;
use App\Models\Farmacia;
use App\Models\administrador;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $admin = auth()->user();
        $termoPesquisa = $request->input('search');

        $query = Medico::has('users', '=', 1);

        if ($termoPesquisa) {
            $query->where(function ($subquery) use ($termoPesquisa) {
                $subquery->where('crm', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhere('especialidade', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhere('cpf', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhere('rg', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhereHas('users', function ($userQuery) use ($termoPesquisa) {
                            $userQuery->where('name', 'LIKE', '%' . $termoPesquisa . '%')
                                      ->orWhere('email', 'LIKE', '%' . $termoPesquisa . '%');
                        });
            });
        }

        $medicos = $query->paginate(5);

        return view('telas.admin.medicos', ['medicos' => $medicos, 'termoPesquisa' => $termoPesquisa]);
    }

    public function indexFarmacias(Request $request)
    {
        $admin = auth()->user();
        $termoPesquisa = $request->input('search');

        $query = Farmacia::has('users', '=', 1);

        if ($termoPesquisa) {
            $query->where(function ($subquery) use ($termoPesquisa) {
                $subquery->where('cnpj', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhere('telefone', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhere('celular', 'LIKE', '%' . $termoPesquisa . '%')
                        ->orWhereHas('users', function ($userQuery) use ($termoPesquisa) {
                            $userQuery->where('name', 'LIKE', '%' . $termoPesquisa . '%')
                                      ->orWhere('email', 'LIKE', '%' . $termoPesquisa . '%');
                        });
            });
        }

        $farmacias = $query->paginate(5);

        return view('telas.admin.farmacias', ['farmacias' => $farmacias, 'termoPesquisa' => $termoPesquisa]);
    }




    public function showMedico($id){
        $medico = Medico::findOrFail($id);
        $user = $medico->users->first();
        return view('telas.admin.medico-show', ['medico' => $medico, 'user' => $user]);
    }

    public function showFarmacia($id){
        $farmacia = Farmacia::findOrFail($id);
        $user = $farmacia->users->first();
        return view('telas.admin.farmacia-show', ['farmacia' => $farmacia, 'user' => $user]);
    }

    public function updateMedico(Request $request , $id){

        $medico = Medico::findOrFail($id);

        $user = $medico->users->first();
        if (!$user) {
            abort(404); 
        }

        $request->validate([
            // User
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'. $user->id,
    
            // Medico
            'consultorio_clinica' => 'required|string|max:255',
            'crm' => 'required|string|unique:medicos,crm,'. $medico->id,
            'cpf' => 'required|unique:medicos,cpf,'. $medico->id .'|formato_cpf', 
            'rg' => 'nullable|string|unique:medicos,rg,'. $medico->id,
            'especialidade' => 'required|string|max:100',
            'data_nascimento' => 'required|string|max:45',
            'telefone' => 'string|max:15|telefone_com_ddd',
            'celular' => 'string|max:15|celular_com_ddd',
            'cep' => 'required|string|max:9|formato_cep',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
            'numero' => 'required|string|max:9',
            'qrcode_assinatura' => 'nullable|string|max:300',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'name.max' => 'O campo Nome deve ter no máximo :max caracteres.',
            'consultorio_clinica.required' => 'O campo Clínica, consultório ou local de atuação é obrigatório.',
            'consultorio_clinica.max' => 'O campo Clínica, consultório ou local de atuação deve ter no máximo :max caracteres.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'O campo Email deve ser um endereço de email válido.',
            'email.max' => 'O campo Email deve ter no máximo :max caracteres.',
            'crm.required' => 'O campo CRM é obrigatório.',
            'crm.unique' => 'Este CRM já está em uso.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.formato_cpf' => 'O campo CPF não está em um formato válido.',
            'rg.unique' => 'Este RG já está em uso.',
            'rg.max' => 'O campo RG deve ter no máximo :max caracteres.',
            'especialidade.required' => 'O campo Especialidade é obrigatório.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
            'telefone.telefone_com_ddd' => 'O campo Telefone não está em um formato válido.',
            'celular.max' => 'O campo Celular deve ter no máximo :max caracteres.',
            'celular.celular_com_ddd' => 'O campo Celular não está em um formato válido.',
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.max' => 'O campo CEP deve ter no máximo :max caracteres.',
            'cep.formato_cep' => 'O campo CEP não está em um formato válido.',
            'estado.required' => 'O campo Estado é obrigatório.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'bairro.required' => 'O campo Bairro é obrigatório.',
            'rua.required' => 'O campo Rua é obrigatório.',
            'numero.required' => 'O campo Número é obrigatório.',
            'telefone.string' => 'O campo Telefone não pode ser vazio.',
            'celular.string' => 'O campo Celular não pode ser vazio.',
        ]);
        
        $medico->consultorio_clinica = $request->input('consultorio_clinica');
        $medico->crm = $request->input('crm');
        $medico->cpf = $request->input('cpf');
        $medico->rg = $request->input('rg');
        $medico->especialidade = $request->input('especialidade');
        $medico->data_nascimento = $request->input('data_nascimento');
        $medico->telefone = $request->input('telefone');
        $medico->celular = $request->input('celular');
        $medico->cep = $request->input('cep');
        $medico->estado = $request->input('estado');
        $medico->cidade = $request->input('cidade');
        $medico->bairro = $request->input('bairro');
        $medico->rua = $request->input('rua');
        $medico->numero = $request->input('numero');
        $medico->save();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        $user->save();

        $request->session()->flash('success', 'Os dados do médico foram atualizados com sucesso.');

        return redirect()->route('admin-medico.show', ['id' => $id]);
    }

    public function deleteMedico($id) {
        $medico = Medico::findOrFail($id);
    
        $usuarios = $medico->users;
    
        $usuarios->each(function ($usuario) {
            $usuario->delete();
        });
    
        $medico->delete();
    
        return redirect()->route('farmacia.home')->with('success', 'Médico e usuários relacionados excluídos com sucesso');
    }
    
    public function updateFarmacia(Request $request, $id)
    {
        $farmacia = Farmacia::findOrFail($id);
        $user = $farmacia->users->first();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'cnpj' => 'required|string|max:14|unique:farmacias,cnpj,' . $farmacia->id,
            'telefone' => 'string|max:15|telefone_com_ddd',
            'celular' => 'string|max:15|celular_com_ddd',
            'cep' => 'required|string|max:9|formato_cep',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
            'numero' => 'required|string|max:9',
        ], [
            'name.required' => 'O campo Nome é obrigatório.',
            'email.required' => 'O campo Email é obrigatório.',
            'email.email' => 'O campo Email deve ser um endereço de email válido.',
            'email.unique' => 'Este Email já está cadastrado.',
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
            'celular.max' => 'O campo Celular deve ter no máximo :max caracteres.',
            'cep.required' => 'O campo CEP é obrigatório.',
            'estado.required' => 'O campo Estado é obrigatório.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'bairro.required' => 'O campo Bairro é obrigatório.',
            'rua.required' => 'O campo Rua é obrigatório.',
            'numero.required' => 'O campo Número é obrigatório.',
            'cnpj.max' => 'O campo CNPJ deve ter no máximo :max caracteres.',
            'cep.max' => 'O campo CEP deve ter no máximo :max caracteres.',
            'estado.max' => 'O campo Estado deve ter no máximo :max caracteres.',
            'cidade.max' => 'O campo Cidade deve ter no máximo :max caracteres.',
            'bairro.max' => 'O campo Bairro deve ter no máximo :max caracteres.',
            'rua.max' => 'O campo Rua deve ter no máximo :max caracteres.',
            'numero.max' => 'O campo Número deve ter no máximo :max caracteres.',
            'telefone.telefone_com_ddd' => 'O campo Telefone deve ser um número de telefone válido com DDD (xx) xxxxx-xxxx.',
            'celular.celular_com_ddd' => 'O campo Celular deve ser um número de celular válido com DDD (xx) xxxxx-xxxx.',
        ]);
    
        $farmacia->cnpj = $request->cnpj;
        $farmacia->telefone = $request->telefone;
        $farmacia->celular = $request->celular;
        $farmacia->cep = $request->cep;
        $farmacia->estado = $request->estado;
        $farmacia->cidade = $request->cidade;
        $farmacia->bairro = $request->bairro;
        $farmacia->rua = $request->rua;
        $farmacia->numero = $request->numero;
        $farmacia->save();
    
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
    
        return redirect()->route('admin-farmacia.show', ['id' => $id])->with('success', 'Farmácia atualizada com sucesso.');
    }

    public function deleteFarmacia($id) {
        $farmacia = Farmacia::findOrFail($id);
    
        $usuarios = $farmacia->users;
    
        $usuarios->each(function ($usuario) {
            $usuario->delete();
        });
    
        $farmacia->delete();
    
        return redirect()->route('admin-farmacia.show')->with('success', 'Farmacia e usuários relacionados excluídos com sucesso');
    }

}
