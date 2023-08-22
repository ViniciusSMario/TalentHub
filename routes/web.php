<?php

use App\Models\Vaga;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

//Site
Route::get('/', [App\Http\Controllers\SiteController::class, 'index'])->name('welcome');
Route::get('/vagas/visualizar/{id}', [App\Http\Controllers\SiteController::class, 'visualizar'])->name('vaga_visualizar');
Route::get('/vagas/candidatar/{id}', [App\Http\Controllers\SiteController::class, 'candidatar'])->name('vaga_candidatar');
Route::post('/vagas/aplicar', [App\Http\Controllers\SiteController::class, 'aplicar'])->name('vaga_aplicar');

//Admin
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Vagas
Route::get('/vagas', [App\Http\Controllers\VagaController::class, 'index'])->name('vagas_index');
Route::get('/vagas/create', [App\Http\Controllers\VagaController::class, 'create'])->name('vagas_create');
Route::post('/vagas/store', [App\Http\Controllers\VagaController::class, 'store'])->name('vagas_store');
Route::get('/vagas/edit/{id}', [App\Http\Controllers\VagaController::class, 'edit'])->name('vagas_edit');
Route::post('/vagas/update', [App\Http\Controllers\VagaController::class, 'update'])->name('vagas_update');
Route::get('/vagas/delete/{id}', [App\Http\Controllers\VagaController::class, 'destroy'])->name('vagas_delete');

Route::get('/candidatos', [App\Http\Controllers\CandidatoController::class, 'index'])->name('candidatos_index');
Route::get('/candidatos/baixar_curriculo/{url_curriculo}', [App\Http\Controllers\CandidatoController::class, 'baixar_curriculo'])->name('baixar_curriculo');
Route::post('/candidatos/cidades', [App\Http\Controllers\CandidatoController::class, 'cidade_por_estado'])->name('cidade_por_estado');
Route::get('/candidatos/{id}', [App\Http\Controllers\CandidatoController::class, 'perfil_candidato'])->name('perfil_candidato');

// Triagem
Route::get('/triagem/{id}', [App\Http\Controllers\TriagemController::class, 'index'])->name('triagem_vaga');
Route::get('/triagem/triagem_teste_comportamental/{id_candidato}/{id_vaga}', [App\Http\Controllers\TriagemController::class, 'triagem_teste_comportamental'])->name('triagem_teste_comportamental');
Route::get('/triagem/triagem_teste_pratico/{id_candidato}/{id_vaga}', [App\Http\Controllers\TriagemController::class, 'triagem_teste_pratico'])->name('triagem_teste_pratico');
Route::get('/triagem/triagem_entrevista/{id_candidato}/{id_vaga}', [App\Http\Controllers\TriagemController::class, 'triagem_entrevista'])->name('triagem_entrevista');
Route::get('/triagem/eliminar_candidato/{id_candidato}/{id_vaga}', [App\Http\Controllers\TriagemController::class, 'eliminar_candidato'])->name('eliminar_candidato');
Route::get('/triagem/aprovar_candidato/{id_candidato}/{id_vaga}', [App\Http\Controllers\TriagemController::class, 'aprovar_candidato'])->name('aprovar_candidato');
