<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Session;
use App\Models\Tema;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= new Tema();
        $temas=$model->AllTemas();
        $contador=$model->CountTemas();
        //var_dump($universidades); exit;
        return view('backend.temas.index', compact('temas','contador')); 
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
        $tema = new Tema();
        $tema->nombre=$request->nombre;
        $tema->estado=1;
        $tema->save();
        Session::flash('flash_message', 'Se registró correctamente el tema!!');
        return redirect('/temas');
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
        $tema=Tema::Find($id);
        return view('backend.temas.edit', compact('tema'));
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
        $tema=Tema::Find($request->id);
        $tema->nombre=$request->nombre;
        $tema->save();
        Session::flash('flash_message', 'Se actualizó correctamente el tema!!');
        return redirect('/temas');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $tema=Tema::Find($id);
        $tema->estado=0;
        $tema->save();
        Session::flash('flash_message', 'Se eliminó correctamente el tema!!');
        return redirect('/temas');
    
    }
}
