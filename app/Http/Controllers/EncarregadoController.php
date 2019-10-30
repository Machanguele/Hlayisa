<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class EncarregadoController extends Controller
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
        try{
            DB::statement('call inserirEncarregado(?,?,?,?,?,?,?,?,?)',
            [
                $request->tNome,
                $request->tApelido,
                $request->tTel,
                $request->tMail,
                $request->tNome,
                $request->get('optradio', 'M'),
                $request->tDocumento,
                $request->tnrID,
                $request->idDate,
            ]);
        }catch(QueryException $qe){
            \report($qe);
        }catch(Exception $e){
            \report($e);
        }
        $idEncarregado = DB::select('select idEncarregado from encarregado where email = ?', [$request->tMail]);
        return view("formularios.formulario", ['idEncarregado'=> $idEncarregado]);

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
