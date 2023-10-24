<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Observacao;

class ObservacaoController extends Controller
{
    public function store(Request $request, $id)
{
    $paciente = Paciente::findOrFail($id);

    $request->validate([
        'observacao' => 'required|string',
    ], [
        'observacao.required' => 'O campo Observação é obrigatório.',
        'observacao.string' => 'O campo Observação deve ser uma string.',
    ]);

    $observacao = Observacao::create([
        'observacao' => $request->input('observacao'),
        'paciente_id' => $id
    ]);

    return redirect()->back()->with('success', 'Observação adicionada com sucesso.');
}

    public function update(Request $request, $id)
    {   
        $observacao = Observacao::findOrFail($id);

        $request->validate([
            'observacao' => 'required|string',
            ], [
            'observacao.required' => 'O campo Observação é obrigatório.',
            'observacao.string' => 'O campo Observação deve ser uma string.',
            ]);

            $observacao->observacao = $request->input('observacao');
            $observacao->save();

        return redirect()->back()->with('success', 'Observação alterada com sucesso.');
    }

    public function destroy($id)
    {
        Observacao::find($id)->delete();
  
        return back();
    }
}
