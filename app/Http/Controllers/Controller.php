<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

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
}
