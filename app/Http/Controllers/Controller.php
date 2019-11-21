<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function formularioAluno()
    {
        return view("formularios.formulario");
    }

    public function formularioEncarregado()
    {
        return view("formularios.formulario_2");
    }

    public function confirmarInscricao()
    {
        return view("formularios.final_step");
    }

    public function login(Request $request){

            $users= DB::select('select nome, apelido from encarregado where email =? and encarregado.password=?', [
                $request->Tmail,
                $request->password
                ]
            );

            foreach ($users as $user) {
                if ($user->nome != "") {
                    dd("Encarregado login");
                }
            }

            $users = DB::select(
                'select nome, apelido, email from funcionario, adminfuncionario where email = ? and funcionario.password=?',
                [
                    $request->Tmail,
                    $request->password,
                ]
            );
            foreach ($users as $user) {
                if ($user->nome != "") {
                    return view("admin.index1", [
                        "users"=>$users,
                    ]);
                }
            }
    }
    public function login1(){
        return view("login.login");
    }
    public function recuperar()
    {
        return view("login.introduzirEmail");
    }

    public function codigo()
    {
        return view("login.codigo");
    }

    public function redifinirSenha()
    {
        return view("login.redifinirSenha");
    }

}
