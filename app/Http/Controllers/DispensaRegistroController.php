<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Paciente;
use App\Models\User;
use App\Models\DispensaRegistro;
use Illuminate\Http\Request;

class DispensaRegistroController extends Controller
{
    public function show($id)
    {

        $dispensa = DispensaRegistro::findOrFail($id);

        if ($dispensa) {
            $receita = $dispensa->receita;
            $prescricoes = $receita->prescricoes;
            $medico = $receita->medico;
            $paciente = $receita->paciente;
            $farmacia = $dispensa->farmacia;
            return view('telas.farmacia.dispensa-show', ['farmacia' => $farmacia,'dispensa'=>$dispensa, 'receita' => $receita, 'prescricoes' => $prescricoes, 'medico' => $medico,'paciente' => $paciente]);
        } else {
            return back()->withErrors(['termo' => 'Dispensa não encontrada.']);
        }
        
    }
}
