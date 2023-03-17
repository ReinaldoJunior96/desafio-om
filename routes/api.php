<?php

use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PacienteController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('pacientes')->group(function () {
    Route::controller(PacienteController::class)->group(function () {
        Route::get('all', 'index');
        Route::get('show/{paciente}', 'show');
        Route::post('to/create', 'store');
        // obs: A rota de update no insomnia deve ser feita com o verbo Post para fins de teste.
        Route::post('to/update/{paciente}', 'update');
        Route::delete('to/delete/{paciente}', 'destroy');


        Route::post('import/csv', 'importarCsv');
        Route::get('show/with/cpf/{cpf}', 'buscarPorCpf');
    });
});

Route::prefix('enderecos')->group(function () {
    Route::controller(EnderecoController::class)->group(function () {
        Route::get('all', 'index');
        Route::get('show/{endereco}', 'show');
        Route::post('to/create', 'store');
        // obs: A rota de update no insomnia deve ser feita com o verbo Post para fins de teste.
        Route::post('to/update/{endereco}', 'update');

        Route::delete('to/delete/{endereco}', 'destroy');

        Route::get('seach/cep/{cep}', 'buscarCep');
    });
});


