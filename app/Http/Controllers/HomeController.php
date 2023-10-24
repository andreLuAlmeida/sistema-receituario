<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            return redirect()->route('admin.home');
        } elseif ($user->isMedico()) {
            $echo = '090';
            return redirect()->route('medico.home');
        } elseif ($user->isFarmacia()) {
            return redirect()->route('farmacia.home');
        }

        return redirect()->route('login')->with('message', 'Usuário inválido');
    }
}
