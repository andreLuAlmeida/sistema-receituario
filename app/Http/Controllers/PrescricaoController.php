<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Receita;
use App\Models\Prescricao;


class PrescricaoController extends Controller
{

    public function store(Request $request, $id)
{
    $receita = Receita::findOrFail($id);

    $request->validate([
        'nome_medicamento' => 'required|string|max:255',
        'dose' => 'required|string|max:255',
        'forma_farmaceutica' => 'required|string|max:255',
        'via_administracao' => 'required|string|max:255',
        'frequencia_administracao' => 'required|string|max:255',
        'horario' => 'required|string|max:255',
        'intervalo_tempo' => 'nullable|string|max:255',
        'quantidade_doses' => 'nullable|integer',
        'quantidade_total' => 'nullable|integer',
        'duracao_tratamento' => 'required|string|max:255',
        'instrucoes_cuidados' => 'nullable|string',
        'outras_orientacoes' => 'nullable|string',
    ], [
        'required' => 'O campo :attribute é obrigatório.',
        'string' => 'O campo :attribute deve ser uma string.',
        'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
        'integer' => 'O campo :attribute deve ser um número inteiro.',
        'numeric' => 'O campo :attribute deve ser um número.',
        'nullable' => 'O campo :attribute pode ser nulo.',
    ]);    

    $prescricao = new Prescricao;
    $prescricao->nome_medicamento = $request->nome_medicamento;
    $prescricao->dose = $request->dose;
    $prescricao->forma_farmaceutica = $request->forma_farmaceutica;
    $prescricao->via_administracao = $request->via_administracao;
    $prescricao->frequencia_administracao = $request->frequencia_administracao;
    $prescricao->horario = $request->horario;
    $prescricao->intervalo_tempo = $request->intervalo_tempo;
    $prescricao->quantidade_doses = $request->quantidade_doses;
    $prescricao->quantidade_total = $request->quantidade_total;
    $prescricao->duracao_tratamento = $request->duracao_tratamento;
    $prescricao->instrucoes_cuidados = $request->instrucoes_cuidados;
    $prescricao->outras_orientacoes = $request->outras_orientacoes;
    $prescricao->receita_id = $id;

    $prescricao->save();

    return redirect()->back();
}

    public function update(Request $request, $id)
    {   
        $prescricao = Prescricao::findOrFail($id);

        $request->validate([
            'nome_medicamento' => 'required|string|max:255',
            'dose' => 'required|string|max:255',
            'forma_farmaceutica' => 'required|string|max:255',
            'via_administracao' => 'required|string|max:255',
            'frequencia_administracao' => 'required|string|max:255',
            'horario' => 'required|string|max:255',
            'intervalo_tempo' => 'nullable|string|max:255',
            'quantidade_doses' => 'nullable|integer',
            'quantidade_total' => 'nullable|integer',
            'duracao_tratamento' => 'required|string|max:255',
            'instrucoes_cuidados' => 'nullable|string',
            'outras_orientacoes' => 'nullable|string',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
            'integer' => 'O campo :attribute deve ser um número inteiro.',
            'numeric' => 'O campo :attribute deve ser um número.',
            'nullable' => 'O campo :attribute pode ser nulo.',
        ]);    
            

        $prescricao->nome_medicamento = $request->nome_medicamento;
        $prescricao->dose = $request->dose;
        $prescricao->forma_farmaceutica = $request->forma_farmaceutica;
        $prescricao->via_administracao = $request->via_administracao;
        $prescricao->frequencia_administracao = $request->frequencia_administracao;
        $prescricao->horario = $request->horario;
        $prescricao->intervalo_tempo = $request->intervalo_tempo;
        $prescricao->quantidade_doses = $request->quantidade_doses;
        $prescricao->quantidade_total = $request->quantidade_total;
        $prescricao->duracao_tratamento = $request->duracao_tratamento;
        $prescricao->instrucoes_cuidados = $request->instrucoes_cuidados;
        $prescricao->outras_orientacoes = $request->outras_orientacoes;
    
        $prescricao->save();

        return redirect()->back()->with('success', 'Observação alterada com sucesso.');
    }

    public function destroy($id)
    {
        Prescricao::find($id)->delete();
  
        return back();
    }
    
}
