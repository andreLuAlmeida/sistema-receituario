<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilePhotoController;
use App\Http\Controllers\FarmaciaController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\AdminLoginController;
use App\Http\Controllers\AdminMedicoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\ObservacaoController;
use App\Http\Controllers\PrescricaoController;
use App\Http\Controllers\DispensaRegistroController;
use App\Mail\Contact;

Route::get('/', function () {
    return view('telas.vitral');
})->name('welcome');


Route::get('/redirects', [HomeController::class,"index"]);

//administrador
Route::get('/revisar/{tokenAprovacao}', [AdminMedicoController::class, 'revisarCadastro']);
Route::middleware(['admin'])->group(function () {
    // Rotas acessíveis apenas para administradores
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.home');
    Route::put('/aprovar/{id}', [AdminMedicoController::class, 'aprovarMedico'])->name('medico.aprovar');
    Route::get('/negar/{id}', [AdminMedicoController::class, 'negarMedico'])->name('medico.negar');
    Route::delete('/admin/medico/deletar{id}', [AdminController::class, 'deleteMedico'])->name('medico.destroy');
    Route::delete('/admin/farmacia/deletar{id}', [AdminController::class, 'deleteFarmacia'])->name('farmacia.destroy');
    Route::get('/admin/medico/{id}', [AdminController::class, 'showMedico'])->name('admin-medico.show');
    Route::get('/admin/farmacias', [AdminController::class, 'indexFarmacias'])->name('admin.farmacias');
    Route::get('/admin/farmacia/{id}', [AdminController::class, 'showFarmacia'])->name('admin-farmacia.show');
    Route::put('/admin/farmacia/atualizar/{id}', [AdminController::class, 'updateFarmacia'])->name('update.farmacia');
    Route::put('/admin/medico/atualizar/{id}', [AdminController::class, 'updateMedico'])->name('update.medico');
});

//farmacia
Route::get('/farmacia/cadastro', [FarmaciaController::class, 'showRegistrationForm'])->name('register.farmacia.form');
Route::post('/farmacia/cadastro', [FarmaciaController::class, 'store'])->name('register.farmacia');
Route::middleware(['farmacia'])->group(function () {
    // Rotas acessíveis apenas para farmácias
    Route::get('/farmacia/home', [FarmaciaController::class, 'index'])->name('farmacia.home');
    //Mostrar dados de farmacia
    Route::get('/farmacia/dados-gerais',[FarmaciaController::class,'show'])->name('farmacia.show');
    //Updates de farmacia
    Route::put('/farmacia/dados-gerais-informacoes/{id}',[FarmaciaController::class,'updateInformacoes'])->name('farmacia.updateinformacoes');
    Route::put('/farmacia/dados-gerais-contatos/{id}',[FarmaciaController::class,'updateContatos'])->name('farmacia.updatecontatos');
    Route::put('/farmacia/dados-gerais-enderecos/{id}',[FarmaciaController::class,'updateEnderecos'])->name('farmacia.updateenderecos');
    //dispensa
    Route::post('receitas/receita/{token}/dispensar', [ReceitaController::class, 'storeDispensa'])
        ->name('dispensa.store');
    Route::get('farmacia/dispensa/{id}', [DispensaRegistroController::class, 'show'])->name('dispensa.show');
});

//medico
Route::get('/medico/cadastro', [MedicoController::class, 'showRegistrationForm'])->name('register.medico.form');
Route::post('/medico/cadastro', [MedicoController::class, 'store'])->name('register.medico');
Route::middleware(['medico'])->group(function () {
    // Rotas acessíveis apenas para médicos aprovados
    Route::get('/medico/home', [MedicoController::class, 'index'])->name('medico.home');
    //Mostrar dados de medico
    Route::get('/medico/dados-gerais',[MedicoController::class,'show'])->name('medico.show');
    //Updates de medico
    Route::put('/medico/dados-gerais-informacoes/{id}',[MedicoController::class,'updateInformacoes'])->name('medico.updateinformacoes');
    Route::put('/medico/dados-gerais-contatos/{id}',[MedicoController::class,'updateContatos'])->name('medico.updatecontatos');
    Route::put('/medico/dados-gerais-enderecos/{id}',[MedicoController::class,'updateEnderecos'])->name('medico.updateenderecos');
    //paciente
    Route::get('/buscar-paciente', [PacienteController::class, 'buscarPaciente'])->name('buscar.paciente');
    Route::get('/medico/pacientes', [PacienteController::class, 'index'])->name('medico.pacientes');
    Route::get('/medico/paciente/criar', [PacienteController::class, 'create'])->name('paciente.create');
    Route::post('/medico/paciente/criar', [PacienteController::class, 'store'])->name('paciente.store');
    Route::delete('/medico/paciente/deletar{id}', [PacienteController::class, 'destroy'])->name('paciente.destroy');
    Route::get('/medico/paciente/{id}', [PacienteController::class, 'show'])->name('paciente.show');
            //observações
            Route::post('/observacao/store{id}', [ObservacaoController::class, 'store'])->name('observacao.store');
            Route::put('/observacao/atualizar/{id}', [ObservacaoController::class, 'update'])->name('observacao.update');
            Route::delete('/observacao/deletar{id}', [ObservacaoController::class, 'destroy'])->name('observacao.destroy');
            //
    Route::get('/medico/paciente/atualizar/{id}', [PacienteController::class, 'edit'])->name('paciente.edit');
    Route::put('/medico/paciente/atualizar/{id}', [PacienteController::class, 'update'])->name('paciente.update');
    //receitas
    Route::get('/medico/receitas', [ReceitaController::class, 'index'])->name('medico.receitas');
    Route::post('/medico/prereceita/criar', [ReceitaController::class, 'prestore'])->name('prereceita.store');
    Route::get('/medico/prereceita/criar', [ReceitaController::class, 'precreate'])->name('prereceita.create');
    Route::get('/medico/receita/{token_aprovacao}', [ReceitaController::class, 'create'])->name('receita.create');
    Route::post('/medico/receita/criar/{id}', [ReceitaController::class, 'store'])->name('receita.store');
    Route::delete('/medico/receita/deletar/{id}', [ReceitaController::class, 'destroy'])->name('receita.destroy');
    Route::get('medico/receitas/receita/{token}', [ReceitaController::class, 'show'])->name('receita.show');
    Route::post('/enviar-qr-code/{token}/{id}', [ReceitaController::class, 'enviarQrCode'])->name('enviar-qr-code');
        //Prescrição
        Route::post('/prescricao/criar/{id}', [PrescricaoController::class, 'store'])->name('prescricao.store');
        Route::put('/prescricao/atualizar/{id}', [PrescricaoController::class, 'update'])->name('prescricao.update');
        Route::delete('/prescricao/deletar{id}', [PrescricaoController::class, 'destroy'])->name('prescricao.destroy');
});

//Contato
Route::get('/contato', [ContactController::class, 'index'])->name('contact.index');
/*Route::get('/contact', function () {
    return new Contact();
});*/
Route::post('/contato', [ContactController::class, 'store'])->name('contact.store');

//Geral
Route::get('receitas/receita/{token}', [ReceitaController::class, 'showForPublic'])->name('receita.show-public');

//Dispensa
Route::middleware(['auth'])->group(function () {
    Route::get('receitas/receita/{token}/dispensar', [ReceitaController::class, 'showDispenseForm'])
        ->name('receita.show-dispense-form');
});






