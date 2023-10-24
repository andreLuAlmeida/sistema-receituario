<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\AprovacaoCadastroMedico;
use App\Notifications\MedicoCadastroSolicitado;
use App\Models\Medico;
use App\Models\User;
use Illuminate\Support\Str;
use App\Notifications\NovoMedicoRegistrado;

class MedicoController extends Controller
{
    public function index()
    {
        $userMedico = Auth::user();

        if ($userMedico->isMedico()) {
            $ultimaReceita = $userMedico->medico->receitas()
                ->whereNotNull('token') // Garante que o campo 'token' não seja nulo
                ->whereNull('token_aprovacao') // Garante que o campo 'token_aprovado' seja nulo
                ->latest()
                ->first();

            $ultimoPaciente = $userMedico->medico->pacientes()->latest()->first();

            return view('telas.medico.home', [
                'ultimaReceita' => $ultimaReceita,
                'ultimoPaciente' => $ultimoPaciente,
            ]);
        }

        return view('telas.medico.home');
    }

    public function showRegistrationForm()
    {
        return view('auth.medico.registro'); // Certifique-se de criar a view correspondente
    }

    public function store(Request $request)
    {
        $request->validate([
            // User
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
    
            // Medico
            'consultorio_clinica' => 'required|string|max:255',
            'crm' => 'required|string|unique:medicos,crm',
            'cpf' => 'required|unique:medicos,cpf|formato_cpf', 
            'rg' => 'nullable|string|unique:medicos,rg',
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
            'email.unique' => 'Este email já está em uso.',
            'email.max' => 'O campo Email deve ter no máximo :max caracteres.',
            'password.required' => 'O campo Senha é obrigatório.',
            'password.min' => 'A senha deve ter pelo menos :min caracteres.',
            'crm.required' => 'O campo CRM é obrigatório.',
            'crm.unique' => 'Este CRM já está em uso.',
            'crm.max' => 'O campo CRM deve ter no máximo :max caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.formato_cpf' => 'O campo CPF não está em um formato válido.',
            'rg.unique' => 'Este RG já está em uso.',
            'rg.max' => 'O campo RG deve ter no máximo :max caracteres.',
            'especialidade.required' => 'O campo Especialidade Médica é obrigatório.',
            'especialidade.max' => 'O campo Especialidade Médica deve ter no máximo :max caracteres.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'data_nascimento.max' => 'O campo Data de Nascimento deve ter no máximo :max caracteres.',
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
    
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        // Gere um token de aprovação único
        $tokenAprovacao = Str::random(64);

        // Verifique se o token já existe no banco de dados
        while (Medico::where('token_aprovacao', $tokenAprovacao)->exists()) {
            $tokenAprovacao = Str::random(64); 
        }        

        $medico = Medico::create([
            
            'consultorio_clinica' => $request->consultorio_clinica,
            'crm' => $request->crm,
            'cpf' => $request->cpf,
            'rg' => $request->rg,
            'especialidade' => $request->especialidade,
            'data_nascimento' => $request->data_nascimento,
            'telefone' => $request->telefone,
            'celular' => $request->celular,
            'cep' => $request->cep,
            'estado' => $request->estado,
            'cidade' => $request->cidade,
            'bairro' => $request->bairro,
            'rua' => $request->rua,
            'numero' => $request->numero,
            'qrcode_assinatura' => $request->qrcode_assinatura,
            'aprovado' => false,
            'token_aprovacao' => $tokenAprovacao,
        ]);

        $user->medico()->associate($medico);
        $user->save();
    
        $userAdmin = User::where('admin', true)->first();
        //dd($userAdmin->email);
        if (!empty($userAdmin->email)) {
            $userAdmin->notify(new NovoMedicoRegistrado($user, $medico));
        } else {                
           
        }

        return redirect()->route('login')
        ->with('success', 'Cadastro realizado. Aguarde pela aprovação, verifique seu email.');
    }

    public function show(){
        $medico = auth()->user()->medico;
        return view('telas.medico.medico-show', ['medico' => $medico]);
    }

    public function updateInformacoes(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);

        $request->validate([
            // Informações
            'consultorio_clinica' => 'required|string|max:255',
            'crm' => 'required|string|unique:medicos,crm,'. $request->id,
            'cpf' => 'required|unique:medicos,cpf,'. $request->id .'|formato_cpf', 
            'rg' => 'nullable|string|unique:medicos,rg,'. $request->id,
            'especialidade' => 'required|string|max:100',
            'data_nascimento' => 'required|string|max:45',
        ], [
            'consultorio_clinica.required' => 'O campo Clínica, consultório ou local de atuação é obrigatório.',
            'consultorio_clinica.max' => 'O campo Clínica, consultório ou local de atuação deve ter no máximo :max caracteres.',
            'crm.required' => 'O campo CRM é obrigatório.',
            'crm.unique' => 'Este CRM já está em uso.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.formato_cpf' => 'O campo CPF não está em um formato válido.',
            'rg.unique' => 'Este RG já está em uso.',
            'rg.max' => 'O campo RG deve ter no máximo :max caracteres.',
            'especialidade.required' => 'O campo Especialidade é obrigatório.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
        ]);

        // Atualize os atributos com os valores do request
        $medico->consultorio_clinica = $request->input('consultorio_clinica');
        $medico->crm = $request->input('crm');
        $medico->cpf = $request->input('cpf');
        $medico->rg = $request->input('rg');
        $medico->especialidade = $request->input('especialidade');
        $medico->data_nascimento = $request->input('data_nascimento');

        // Salve as alterações
        $medico->save();

        // Redirecione para a página de visualização ou faça qualquer outra ação necessária
        return redirect()->route('medico.show')->with('success', 'As informações foram atualizadas com sucesso.');
    }

    public function updateContatos(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);

        $request->validate([
            // Contato
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

        $medico->telefone = $request->input('telefone');
        $medico->celular = $request->input('celular');

        $medico->save();

        return redirect()->route('medico.show')->with('success', 'Informações de contato atualizadas com sucesso!');
    }


    public function updateEnderecos(Request $request, $id)
    {
        $medico = Medico::findOrFail($id);

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

        $medico->cep = $request->input('cep');
        $medico->estado = $request->input('estado');
        $medico->cidade = $request->input('cidade');
        $medico->bairro = $request->input('bairro');
        $medico->rua = $request->input('rua');
        $medico->numero = $request->input('numero');

        // Salve as alterações
        $medico->save();

        return redirect()->route('medico.show')->with('success', 'Endereço atualizado com sucesso!');
    }
}
