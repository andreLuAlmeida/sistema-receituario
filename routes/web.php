<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\AdminLoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Rota para exibir o formulário de registro de farmácia
Route::get('/farmacia/cadastro', [FarmaciaController::class, 'showRegistrationForm'])->name('farmacia.register.form');

// Rota para processar o registro de farmácia
Route::post('/farmacia/cadastro', [FarmaciaController::class, 'register'])->name('farmacia.register');

//Cdastro medico
Route::get('/cadastro-medico', [MedicoController::class, 'showRegistrationForm'])->name('cadastro.medico');
Route::post('/cadastro-medico', [MedicoController::class, 'register'])->name('cadastro.medico.submit');

Route::get('/pedidos-registro/{id}', [MedicoController::class, 'showPedidoRegistro'])->name('pedido.registro');
Route::post('/pedidos-registro/{id}/aprovar-negar', [MedicoController::class, 'aprovarNegarMedico'])->name('medico.aprovar.negar');

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');