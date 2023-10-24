<?php

namespace App\Http\Controllers;
use App\Notifications\MedicoNegadoNotification;

use Illuminate\Http\Request;
use App\Models\Medico;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Notifications\MedicoAprovadoNotification;

class AdminMedicoController extends Controller
{
    public function revisarCadastro($tokenAprovacao)
    {
        $medico = Medico::where('token_aprovacao', $tokenAprovacao)->first();

        if (!$medico) {
             abort(404);
        }

        $user = $medico->users->first();

        if (!$user) {
            abort(404); // Você também pode adicionar uma verificação para o usuário, se necessário
        }

        return view('telas.admin.revisao', ['medico' => $medico, 'user' => $user]);
    }

    public function aprovarMedico(Request $request , $id)
    {
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
        $medico->aprovado = true;
        $medico->token_aprovacao = null;
        $medico->save();

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        $user->notify(new MedicoAprovadoNotification());

        return redirect()->route('login')->with('success', 'O usuário médico foi aprovado com sucesso.');
        
    }

    public function negarMedico($id)
    {
        $medico = Medico::findOrFail($id);

        $user = $medico->users->first();
        if (!$user) {
            abort(404); 
        }

        $medico->aprovado = false;
        $medico->token_aprovacao = null;
        $medico->save();

        $user->notify(new MedicoNegadoNotification());

        return redirect()->route('login')->with('success', 'O requerimento para usuário médico foi negado com sucesso.');
    }
}
