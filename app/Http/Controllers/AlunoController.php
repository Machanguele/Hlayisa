<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class AlunoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

            DB::statement(
                'call inserirAluno(?,?,?,?,?,?,?,?,?,?,?,?,?,?)',
                [
                    $request->tNome,
                    $request->tApelido,
                    $request->idDate,
                    $request->get('optradio', 'M'),
                    $request->get('optradio1', 'nao'),
                    $request->comment,
                    $request->idEncarregado,
                    $request->tipoDocumento,
                    $request->tnrID,
                    $request->tRua,
                    $request->tBairro,
                    $request->tQuart,
                    $request->tAven,
                    $request->tcasa,
                ]
            );

        $encarregado = DB::select('select password from encarregado where password = ?', [$request->idEncarregado,]);
        $entidade=DB::select('select entidade from entidade');
        $users = DB::select('select idAluno, nome, apelido from aluno where nrDocumento=?', [$request->tnrID]);

        $referencia="";

        foreach($users as $user){
            $referencia=DB::select('select referencia from alunoinscricao where idAluno=?', [$user->idAluno]);
        }
        return view("formularios.final_step", [
            'encarregado'=> $encarregado,
            'entidade'=> $entidade,
            'referencia'=> $referencia,
            'users'=>$users,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
