<?php

namespace App\Http\Controllers;

use App\Models\Receita;
use App\Models\Paciente;
use App\Models\User;
use App\Models\DispensaRegistro;
use App\Models\RegistroDeDispensa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\EnviarLinkReceita;

class ReceitaController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
    
        $receitas = Receita::where('token', '!=', null)
            ->when($search, function ($query) use ($search) {
                return $query->whereHas('paciente', function ($subQuery) use ($search) {
                    $subQuery->whereRaw("CONCAT(nome, ' ', sobrenome) like ?", ['%' . $search . '%']);
                });
            })
            ->orderBy('data_prescricao', 'desc')
            ->paginate(3);
    
        return view('telas.medico.receitas', compact('receitas'));
    }


    public function precreate()
    {
        return view('telas.medico.prereceita-create');
    }

    public function prestore(Request $request)
    {
        $request->validate([
            'termo' => 'required',
        ], [
            'termo.required' => 'O campo de busca é obrigatório.',
        ]);

        $termo = $request->input('termo');

        $paciente = Paciente::where(function ($query) use ($termo) {
            $query->whereRaw("CONCAT(nome, ' ', sobrenome) LIKE ?", ["%$termo%"])
                ->orWhere('cpf', $termo)
                ->orWhere('rg', $termo);
        })->first();
    
        if ($paciente) {

            $user = auth()->user();
            $medico = $user->medico->id;

        $receita = new Receita();
        $receita->medico_id = $medico;
        $receita->paciente_id = $paciente->id;
        $receita->observacoes = '';
        $receita->data_prescricao = now();

        $token_unico = null;

        do {
            $novo_token = bin2hex(random_bytes(16));
            $token_existente = Receita::where('token_aprovacao', $novo_token)->first();
                
            if (!$token_existente) {
                $token_unico = $novo_token;
            }
        } while ($token_unico === null);

        $receita->token_aprovacao = $token_unico;

        $receita->save();

        return redirect()->route('receita.create', $receita->token_aprovacao);

        } else {
            return back()->withErrors(['termo' => 'Paciente não encontrado.']);
        }
        
    }

    public function create($token_aprovacao)
    {
        $receita = Receita::where('token_aprovacao', $token_aprovacao)->first();

        $prescricoes = $receita->prescricoes;

        return view('telas.medico.receita-create', ['receita' => $receita, 'prescricoes' => $prescricoes]);
    }

    public function store(Request $request, $id)
    {
        $receita = Receita::findOrFail($id);
        $receita->observacoes = $request->input('observacoes');
        $receita->data_prescricao = now();
        $receita->token_aprovacao = null; 
        $receita->ativa = true;

        $token_unico = null;

        do {
            $novo_token = bin2hex(random_bytes(16));
            $token_existente = Receita::where('token', $novo_token)->first();
                
            if (!$token_existente) {
                $token_unico = $novo_token;
            }
        } while ($token_unico === null);

        $receita->token = $token_unico;

        $receita->save();
        return redirect()->route('receita.show', $receita->token);
    }

    public function show($token)
    {

        $receita = Receita::where('token', $token)->first();
        if ($receita) {
            $medico = $receita->medico;
            $paciente = $receita->paciente;
            $prescricoes = $receita->prescricoes;
            return view('telas.medico.receita-show', ['receita' => $receita, 'prescricoes' => $prescricoes, 'medico' => $medico,'paciente' => $paciente]);
        } else {
            return back()->withErrors(['termo' => 'Receita não encontrada.']);
        }
        
    }

    public function showForPublic($token)
{
    $receita = Receita::where('token', $token)->firstOrFail();
    $medico = $receita->medico;
    $paciente = $receita->paciente;
    $prescricoes = $receita->prescricoes;

    $dispensa = RegistroDeDispensa::where('receitas_id', $receita->id)->first();
    return view('telas.receita.show-public', [
        'receita' => $receita,
        'prescricoes' => $prescricoes,
        'medico' => $medico,
        'paciente' => $paciente,
        'dispensa' => $dispensa,
    ]);
}

    public function showDispenseForm($token)
    {
        $user = auth()->user();
        
        if ($user->isFarmacia() != true){
            return redirect()->route('login')->with('error', 'Você não possui as permissões necessárias para acessar esta funcionalidade como farmácia.');
        }

        $receita = Receita::where('token', $token)->firstOrFail();
        $medico = $receita->medico;
        $paciente = $receita->paciente;
        $prescricoes = $receita->prescricoes;
        return view('telas.receita.dispensa', ['receita' => $receita, 'prescricoes' => $prescricoes, 'medico' => $medico, 'paciente' => $paciente]);
    }

    public function storeDispensa(Request $request, $token)
    {
        $user = auth()->user();
        $receita = Receita::where('token', $token)->firstOrFail();

        $request->validate([
            'nome_balconista' => 'required|string|max:100',
        ], [
            'required' => 'O campo :attribute é obrigatório.',
            'string' => 'O campo :attribute deve ser uma string.',
            'max' => 'O campo :attribute não pode ter mais de :max caracteres.',
        ]);    

        $dispensaRegistro = new DispensaRegistro();
        $dispensaRegistro->farmacias_id = $user->farmacia->id;
        $dispensaRegistro->receitas_id = $receita->id;
        $dispensaRegistro->data_dispensa = now();
        $dispensaRegistro->conteudo_da_dispensa = $request->input('conteudo_da_dispensa');
        $dispensaRegistro->nome_balconista = $request->input('nome_balconista');
        $dispensaRegistro->crf = $request->input('crf');
        
        if ($dispensaRegistro->save()) {
            return redirect()->route('farmacia.home')->with('success', 'A dispensa foi registrada com sucesso.');
        } else {
            return redirect()->back()->with('error', 'Ocorreu um erro ao registrar a dispensa.');
        }

    }

    public function enviarQrCode($token, $id)
{
    $user = auth()->user();
    $paciente = Paciente::find($id);

    if ($paciente) {
        Mail::to($paciente->email)->send(new EnviarLinkReceita($token, $user));

        return redirect()->back()->with('success', 'Receita enviado com sucesso.');
    } else {
        return redirect()->back()->with('error', 'Paciente não encontrado.');
    }
}


}
