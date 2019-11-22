<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function dashboard(){
        return view("admin.index1");
    }
    public function listar(){
        return view("admin.listarAlunos");
    }
}
