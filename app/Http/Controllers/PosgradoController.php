<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;

use App\Models\Posgrado;
use App\Models\Universidade;

class PosgradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $model= new Posgrado();
        $posgrados=$model->ShowPosgradosByIdUniversidad($id);
        $contador=$model->CountPosgradosByIdUniversidad($id);
        $universidad= Universidade::Find($id);
        return view('backend.posgrados.index', compact('posgrados','universidad','contador')); 
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
        $posgrado = new Posgrado();
        $posgrado->nombre_completo=$request->nombre_completo;
        $posgrado->mencion=$request->mencion;
        $posgrado->tipo=$request->tipo;
        $posgrado->universidad_id=$request->universidad_id;
        $posgrado->estado=1;
        $posgrado->save();
        Session::flash('flash_message', 'Se registró correctamente el Posgrado!!');
        return redirect('/posgrados/'.$request->universidad_id);
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
        $posgrado=Posgrado::Find($id);
        return view('backend.posgrados.edit', compact('posgrado'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $posgrado=Posgrado::Find($request->id);
        $posgrado->nombre_completo=$request->nombre_completo;
        $posgrado->mencion=$request->mencion;
        $posgrado->tipo=$request->tipo;
        $posgrado->save();
        Session::flash('flash_message', 'Se actualizó correctamente el Posgrado!!');
        return redirect('/posgrados/'.$request->universidad_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $posgrado=Posgrado::Find($id);
        $posgrado->estado=0;
        $posgrado->save();
        Session::flash('flash_message', 'Se eliminó correctamente el Posgrado!!');
        return redirect('/posgrados/'.$posgrado->universidad_id);
    }
}
