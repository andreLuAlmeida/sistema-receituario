<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AprovacaoCadastroMedico;
use App\Notifications\NovoMedicoCadastroNotification;
use App\Models\Medico;
use App\Models\User;

class MedicoController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.medico-register'); // Certifique-se de criar a view correspondente
    }

    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'especialidade' => 'required|string',
            'crm' => 'required|string|max:10',
            'cpf' => 'required|string|max:15',
            'rg' => 'nullable|string|max:15',
            'data_nascimento' => 'required|string|max:45',
            'telefone' => 'nullable|string|max:15',
            'celular' => 'nullable|string|max:45',
            'cep' => 'required|string|max:9',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make('password'), // Defina a senha padrão ou permita que o usuário defina
        ]);

        $medico = new Medico([
            'especialidade' => $validatedData['especialidade'],
            'crm' => $validatedData['crm'],
            'cpf' => $validatedData['cpf'],
            'rg' => $validatedData['rg'],
            'data_nascimento' => $validatedData['data_nascimento'],
            'telefone' => $validatedData['telefone'],
            'celular' => $validatedData['celular'],
            'cep' => $validatedData['cep'],
            'estado' => $validatedData['estado'],
            'cidade' => $validatedData['cidade'],
            'bairro' => $validatedData['bairro'],
            'rua' => $validatedData['rua'],
            'aprovado' => false,
        ]);
        $user->medico()->save($medico);

        // Notificar o administrador sobre o novo cadastro
        $admin = User::findOrFail(1); // Supondo que o ID do administrador seja 1
        $admin->notify(new NovoMedicoCadastroNotification($medico, $medico->id));

        return redirect()->route('dashboard')->with('status', 'Seu cadastro foi enviado para aprovação.');
    }

    // Outros métodos do MedicoController

    public function showPedidoRegistro($id)
    {
        $medico = Medico::findOrFail($id);
        // Verificar se o usuário logado é o administrador
        if (Auth::user()->isAdmin()) {
            return view('admin.pedido-registro', compact('medico'));
        } else {
            return redirect('/')->with('error', 'Você não tem permissão para acessar essa página.');
        }
    }

    public function aprovarNegarMedico(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);

        if (Auth::user()->isAdmin()) { // Verifica se o usuário é um administrador
            if ($request->has('aprovar')) {
                $medico->aprovado = true;
                $medico->save();

                // Enviar e-mail de aprovação
                Mail::to($medico->email)->send(new AprovacaoCadastroMedico(true));

                return redirect()->route('pedido.registro', $id)->with('status', 'Cadastro aprovado com sucesso.');
            } elseif ($request->has('negar')) {
                // Você pode marcar o médico como negado ou excluir, dependendo do cenário
                $medico->delete();

                // Enviar e-mail de negação
                Mail::to($medico->email)->send(new AprovacaoCadastroMedico(false));

                return redirect()->route('pedido.registro', $id)->with('status', 'Cadastro negado com sucesso.');
            }

            return redirect()->route('pedido.registro', $id)->with('error', 'Ação inválida.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Você não tem permissão para acessar essa página.');
        }
    }
}
