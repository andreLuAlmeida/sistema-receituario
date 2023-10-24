<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Observacao;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class PacienteController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        if ($user->isMedico()) {
            $medico = $user->medico;
            $search = $request->input('search'); 
        
            if ($search) {
                $pacientes = $medico->pacientes()
                    ->whereRaw("CONCAT(nome, ' ', sobrenome) LIKE ?", ["%$search%"])
                    ->orWhere('email', 'LIKE', "%$search%")
                    ->orWhere('cpf', 'LIKE', "%$search%")
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            } else {
                $pacientes = $medico->pacientes()
                    ->orderBy('created_at', 'desc')
                    ->paginate(10);
            }

            return view('telas.medico.pacientes', compact('pacientes'));
        } else {
            return redirect()->route('logout');
        }
    }


    public function create(){
            return view('telas.medico.paciente-create');
    }

    public function store(Request $request){

        $validator = $request->validate([
            'nome' => 'required|string|max:100',
            'sobrenome' => 'required|string|max:100',
            'cpf' => 'required|unique:pacientes,cpf|formato_cpf',
            'email' => 'required|unique:pacientes,email|email|max:320',
            'rg' => 'required|unique:pacientes,rg|max:15',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string|max:45',
            'profissao' => 'required|string|max:100',
            'telefone' => 'required|string|max:15|telefone_com_ddd',
            'celular' => 'nullable|string|max:45|celular_com_ddd',
            'cep' => 'required|string|max:9|formato_cep',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
            'numero_residencial' => 'required|string|max:10',
        ], [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.max' => 'O campo Nome deve ter no máximo :max caracteres.',
            'sobrenome.required' => 'O campo Sobrenome é obrigatório.',
            'sobrenome.max' => 'O campo Sobrenome deve ter no máximo :max caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.formato_cpf' => 'O campo CPF não está em um formato válido (exemplo válido: 123.456.789-09).',
            'email.required' => 'O campo Email é obrigatório.',
            'email.unique' => 'Este email já está em uso.',
            'email.email' => 'O campo Email deve ser um endereço de email válido.',
            'email.max' => 'O campo Email deve ter no máximo :max caracteres.',
            'rg.required' => 'O campo RG é obrigatório.',
            'rg.unique' => 'Este RG já está em uso.',
            'rg.max' => 'O campo RG deve ter no máximo :max caracteres.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
            'sexo.required' => 'O campo Sexo é obrigatório.',
            'sexo.max' => 'O campo Sexo deve ter no máximo :max caracteres.',
            'profissao.required' => 'O campo Profissão é obrigatório.',
            'profissao.max' => 'O campo Profissão deve ter no máximo :max caracteres.',
            'telefone.required' => 'O campo Telefone é obrigatório.',
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
            'telefone.telefone_com_ddd' => 'O campo Telefone não está em um formato válido (exemplo válido: (11) 1234-5678).',
            'celular.max' => 'O campo Celular deve ter no máximo :max caracteres.',
            'celular.celular_com_ddd' => 'O campo Celular não está em um formato válido (exemplo válido: (11) 98765-4321).',
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.max' => 'O campo CEP deve ter no máximo :max caracteres.',
            'cep.formato_cep' => 'O campo CEP não está em um formato válido (exemplo válido: 12345-678).',
            'estado.required' => 'O campo Estado é obrigatório.',
            'estado.max' => 'O campo Estado deve ter no máximo :max caracteres.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'cidade.max' => 'O campo Cidade deve ter no máximo :max caracteres.',
            'bairro.required' => 'O campo Bairro é obrigatório.',
            'bairro.max' => 'O campo Bairro deve ter no máximo :max caracteres.',
            'rua.required' => 'O campo Rua é obrigatório.',
            'rua.max' => 'O campo Rua deve ter no máximo :max caracteres.',
            'numero_residencial.required' => 'O campo Número Residencial é obrigatório.',
            'numero_residencial.max' => 'O campo Número Residencial deve ter no máximo :max caracteres.',
        ]);

        $paciente = new Paciente();

        $paciente->nome = $request->input('nome');
        $paciente->sobrenome = $request->input('sobrenome');
        $paciente->cpf = $request->input('cpf');
        $paciente->data_nascimento = $request->input('data_nascimento');
        $paciente->sexo = $request->input('sexo');
        $paciente->profissao = $request->input('profissao');
        $paciente->rg = $request->input('rg');
        $paciente->email = $request->input('email');
        $paciente->telefone = $request->input('telefone');
        $paciente->celular = $request->input('celular');
        $paciente->cep = $request->input('cep');    
        $paciente->estado = $request->input('estado');
        $paciente->cidade = $request->input('cidade');
        $paciente->bairro = $request->input('bairro');
        $paciente->rua = $request->input('rua');
        $paciente->numero_residencial = $request->input('numero_residencial');
        $paciente->idade = $request->input('idade');
            $dataNascimento = Carbon::parse($request->input('data_nascimento'));
            $dataAtual = Carbon::now();
            $idade = $dataNascimento->diffInYears($dataAtual);
        $paciente->idade = $idade;

        $user = Auth::user();
        $medico = $user->medico;
        $medico->pacientes()->save($paciente);

        $message = 'Paciente '.$paciente->nome.' '.$paciente->sobrenome.' adicionado com sucesso ao médico.';
        return redirect()->route('medico.pacientes')->with('success', $message);

    }

    public function show($id){
        $paciente = Paciente::findOrFail($id);
        $observacoes = $paciente->observacoes;
        return view('telas.medico.paciente-show', ['paciente' => $paciente, 'observacoes' => $observacoes]);
    }

    public function destroy($id)
    {
        Paciente::find($id)->delete();
  
        return back();
    }

    public function edit($id){
        $paciente = Paciente::findOrFail($id);
        return view('telas.medico.paciente-edit', ['paciente' => $paciente]);
    }

    public function update(Request $request, $id){

        $paciente = Paciente::findOrFail($id);

        $validator = $request->validate([
            'nome' => 'required|string|max:100',
            'sobrenome' => 'required|string|max:100',
            'cpf' => 'required|unique:pacientes,cpf,' . $request->id . '|formato_cpf',
            'email' => 'required|unique:pacientes,email,' . $request->id . '|email|max:320',
            'rg' => 'required|unique:pacientes,rg,' . $request->id . '|max:15',
            'data_nascimento' => 'required|date',
            'sexo' => 'required|string|max:45',
            'profissao' => 'required|string|max:100',
            'telefone' => 'required|string|max:15|telefone_com_ddd',
            'celular' => 'nullable|string|max:45|celular_com_ddd',
            'cep' => 'required|string|max:9|formato_cep',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
            'numero_residencial' => 'required|string|max:10',
        ], [
            'nome.required' => 'O campo Nome é obrigatório.',
            'nome.max' => 'O campo Nome deve ter no máximo :max caracteres.',
            'sobrenome.required' => 'O campo Sobrenome é obrigatório.',
            'sobrenome.max' => 'O campo Sobrenome deve ter no máximo :max caracteres.',
            'cpf.required' => 'O campo CPF é obrigatório.',
            'cpf.unique' => 'Este CPF já está em uso.',
            'cpf.formato_cpf' => 'O campo CPF não está em um formato válido (exemplo válido: 123.456.789-09).',
            'email.required' => 'O campo Email é obrigatório.',
            'email.unique' => 'Este email já está em uso.',
            'email.email' => 'O campo Email deve ser um endereço de email válido.',
            'email.max' => 'O campo Email deve ter no máximo :max caracteres.',
            'rg.required' => 'O campo RG é obrigatório.',
            'rg.unique' => 'Este RG já está em uso.',
            'rg.max' => 'O campo RG deve ter no máximo :max caracteres.',
            'data_nascimento.required' => 'O campo Data de Nascimento é obrigatório.',
            'data_nascimento.date' => 'O campo Data de Nascimento deve ser uma data válida.',
            'sexo.required' => 'O campo Sexo é obrigatório.',
            'sexo.max' => 'O campo Sexo deve ter no máximo :max caracteres.',
            'profissao.required' => 'O campo Profissão é obrigatório.',
            'profissao.max' => 'O campo Profissão deve ter no máximo :max caracteres.',
            'telefone.required' => 'O campo Telefone é obrigatório.',
            'telefone.max' => 'O campo Telefone deve ter no máximo :max caracteres.',
            'telefone.telefone_com_ddd' => 'O campo Telefone não está em um formato válido (exemplo válido: (11) 1234-5678).',
            'celular.max' => 'O campo Celular deve ter no máximo :max caracteres.',
            'celular.celular_com_ddd' => 'O campo Celular não está em um formato válido (exemplo válido: (11) 98765-4321).',
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.max' => 'O campo CEP deve ter no máximo :max caracteres.',
            'cep.formato_cep' => 'O campo CEP não está em um formato válido (exemplo válido: 12345-678).',
            'estado.required' => 'O campo Estado é obrigatório.',
            'estado.max' => 'O campo Estado deve ter no máximo :max caracteres.',
            'cidade.required' => 'O campo Cidade é obrigatório.',
            'cidade.max' => 'O campo Cidade deve ter no máximo :max caracteres.',
            'bairro.required' => 'O campo Bairro é obrigatório.',
            'bairro.max' => 'O campo Bairro deve ter no máximo :max caracteres.',
            'rua.required' => 'O campo Rua é obrigatório.',
            'rua.max' => 'O campo Rua deve ter no máximo :max caracteres.',
            'numero_residencial.required' => 'O campo Número Residencial é obrigatório.',
            'numero_residencial.max' => 'O campo Número Residencial deve ter no máximo :max caracteres.',
        ]);

        $paciente->nome = $request->input('nome');
        $paciente->sobrenome = $request->input('sobrenome');
        $paciente->cpf = $request->input('cpf');
        $paciente->data_nascimento = $request->input('data_nascimento');
        $paciente->sexo = $request->input('sexo');
        $paciente->profissao = $request->input('profissao');
        $paciente->rg = $request->input('rg');
        $paciente->email = $request->input('email');
        $paciente->telefone = $request->input('telefone');
        $paciente->celular = $request->input('celular');
        $paciente->cep = $request->input('cep');    
        $paciente->estado = $request->input('estado');
        $paciente->cidade = $request->input('cidade');
        $paciente->bairro = $request->input('bairro');
        $paciente->rua = $request->input('rua');
        $paciente->numero_residencial = $request->input('numero_residencial');
        $paciente->idade = $request->input('idade');
            $dataNascimento = Carbon::parse($request->input('data_nascimento'));
            $dataAtual = Carbon::now();
            $idade = $dataNascimento->diffInYears($dataAtual);
        $paciente->idade = $idade;
        
        if ($paciente->update()) {
            return redirect()->route('paciente.show', $paciente->id)->with('status', 'Paciente atualizado com sucesso!');
        } else {
            return redirect()->route('pacientes.show', $paciente->id)->with('error', 'Erro ao atualizar o paciente.');
        }
    }
   
}
