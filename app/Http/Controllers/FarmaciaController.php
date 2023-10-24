<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

use App\Models\User;
use App\Models\Farmacia;

class FarmaciaController extends Controller
{
    public function showRegistrationForm()
    {
        return view('auth.farmacia.register_pharmacy');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'cnpj' => 'required|string|size:14|unique:farmacias',
            'telefone' => 'nullable|string|max:15',
            'celular' => 'nullable|string|max:45',
            'cep' => 'required|string|size:9',
            'estado' => 'required|string|max:17',
            'cidade' => 'required|string|max:100',
            'bairro' => 'required|string|max:100',
            'rua' => 'required|string|max:100',
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
        ]);

        $user->farmacia()->save($farmacia);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('dashboard'); // Altere para a rota que você deseja redirecionar após o cadastro.
    }
}
