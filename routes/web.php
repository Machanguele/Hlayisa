<?php

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

Route::get('formularioAluno', 'Controller@formularioAluno');
Route::get('formularioEncarregado', 'Controller@formularioEncarregado');
Route::get('confirmarInscricao', "Controller@confirmarInscricao");

Route::post('encarregado.store', 'EncarregadoController@store');
Route::post('aluno.store', 'AlunoController@store');
