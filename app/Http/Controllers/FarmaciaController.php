<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Models\Farmacia;
use App\Models\RegistroDeDispensa;

class FarmaciaController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();
        $farmacia = $user->farmacia;
    
        $search = $request->input('search'); // Obtém o termo de pesquisa do formulário
    
        if ($search) {
            $registrosDeDispensas = $farmacia->registrosDeDispensas()
                ->where('data_dispensa', 'LIKE', "%$search%")
                ->orWhere('conteudo_da_dispensa', 'LIKE', "%$search%")
                ->orWhere('nome_balconista', 'LIKE', "%$search%")
                ->orWhere('crf', 'LIKE', "%$search%")
                ->orderBy('data_dispensa', 'desc')
                ->paginate(10);
        } else {
            $registrosDeDispensas = $farmacia->registrosDeDispensas()
                ->orderBy('data_dispensa', 'desc')
                ->paginate(10);
        }
    
        return view('telas.farmacia.home', [
            'registrosDeDispensas' => $registrosDeDispensas,
        ]);
    }
    

    public function showRegistrationForm()
    {
        return view('auth.farmacia.registro');
    }

    public function store(Request $request)
    {
        $request->validate([
            // Usuário
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        
            // Farmácia
            'cnpj' => 'required|string|unique:farmacias|max:14',
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
            'password.required' => 'O campo Senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
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
        
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        $farmacia = Farmacia::create([
            'cnpj' => $request->cnpj,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
            'cep' => $request->cep,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'numero' => $request->numero,
        ]);
    
        $user->farmacia()->associate($farmacia);
        $user->save();
        
        return redirect()->route('login')
            ->with('success', 'Farmácia registrada com sucesso. Faça login para continuar.');
    }

    public function show(){
        $farmacia = auth()->user()->farmacia;
        return view('telas.farmacia.farmacia-show', ['farmacia' => $farmacia]);
    }

    public function updateInformacoes(Request $request)
    {
        $user = auth()->user();
        $farmacia = $user->farmacia;

        $request->validate([
            'cnpj' => 'required|string|unique:farmacias,cnpj,'. $request->id .'|max:14',
        ], [
            'cnpj.required' => 'O campo CNPJ é obrigatório.',
            'cnpj.string' => 'O campo CNPJ deve ser uma string válida.',
            'cnpj.unique' => 'Este CNPJ já está cadastrado.',
            'cnpj.max' => 'O campo CNPJ deve ter no máximo :max caracteres.',
        ]);

        
        $farmacia->cnpj = $request->input('cnpj');
        $farmacia->save();

        return redirect()->route('farmacia.show')->with('success', 'As informações foram atualizadas com sucesso.');
    }

    public function updateContatos(Request $request)
    {
        $user = auth()->user();
        $farmacia = $user->farmacia;

        $request->validate([
            'telefone' => 'string|max:15|telefone_com_ddd',
            'celular' => 'string|max:15|celular_com_ddd',
        ], [
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
            'telefone.telefone_com_ddd' => 'O campo Telefone não está em um formato válido.',
            'celular.max' => 'O campo Celular deve ter no máximo :max caracteres.',
            'celular.celular_com_ddd' => 'O campo Celular não está em um formato válido.',
            'telefone.string' => 'O campo Telefone não pode ser vazio.',
            'celular.string' => 'O campo Celular não pode ser vazio.',
        ]);

        $farmacia->telefone = $request->input('telefone');
        $farmacia->celular = $request->input('celular');

        $farmacia->save();

        return redirect()->route('farmacia.show')->with('success', 'Informações de contato atualizadas com sucesso!');
    }


    public function updateEnderecos(Request $request)
    {
        $user = auth()->user();
        $farmacia = $user->farmacia;

        $request->validate([
            // Endereço
            'cep' => 'required|string|max:9|formato_cep',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
            'numero' => 'required|string|max:9',
        ], [
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.max' => 'O campo CEP deve ter no máximo :max caracteres.',
            'cep.formato_cep' => 'O campo CEP não está em um formato válido.',
            'estado.required' => 'O campo Estado é obrigatório.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'bairro.required' => 'O campo Bairro é obrigatório.',
            'rua.required' => 'O campo Rua é obrigatório.',
            'numero.required' => 'O campo Número é obrigatório.',
        ]);

        $farmacia->cep = $request->input('cep');
        $farmacia->estado = $request->input('estado');
        $farmacia->cidade = $request->input('cidade');
        $farmacia->bairro = $request->input('bairro');
        $farmacia->rua = $request->input('rua');
        $farmacia->numero = $request->input('numero');

        // Salve as alterações
        $farmacia->save();

        return redirect()->route('farmacia.show')->with('success', 'Endereço atualizado com sucesso!');
    }

}
