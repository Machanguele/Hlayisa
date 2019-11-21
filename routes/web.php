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
Route::get('login1', 'Controller@login1');
Route::get('recuperar', 'Controller@recuperar');
Route::get('codigo', 'Controller@codigo');
Route::get('senha', 'Controller@redifinirSenha');
Route::get("admin", "adminController@dashboard");
Route::get("showAluno", "adminController@listar");

Route::post('encarregado.store', 'EncarregadoController@store');
Route::post('aluno.store', 'AlunoController@store');
Route::post('login', 'Controller@login');
Route::post('recuperar', 'Controller@recuperar');
Route::post('codigo1', 'Controller@codigo');
Route::post('senha', 'Controller@redifinirSenha');
