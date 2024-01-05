<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Universidade;
use UnitEnum;

class UniversidadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model= new Universidade();
        $universidades=$model->AllUniversidadesActivos();
        //var_dump($universidades); exit;
        return view('backend.universidades.index', compact('universidades')); 
    }

    public function universidades(){

        $model= new Universidade();
        $universidades=$model->AllUniversidadesActivos();
        return view('frontend.universidades.index', compact('universidades')); 
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
        $universidad = new Universidade();
        $universidad->nombre=$request->nombre;
        $universidad->sigla=$request->sigla;
        $universidad->departamento=$request->departamento;
        $universidad->provincia=$request->provincia;
        $universidad->distrito=$request->distrito;
        $universidad->estado=1;
        $universidad->save();
        Session::flash('flash_message', 'Se registró correctamente la Universidad!!');
        return redirect('/universidades');

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
        $universidad=Universidade::Find($id);
        return view('backend.universidades.edit', compact('universidad'));
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
        $universidad=Universidade::Find($request->id);
        $universidad->nombre=$request->nombre;
        $universidad->sigla=$request->sigla;
        $universidad->departamento=$request->departamento;
        $universidad->provincia=$request->provincia;
        $universidad->distrito=$request->distrito;
        $universidad->save();
        Session::flash('flash_message', 'Se actualizó correctamente la Universidad!!');
        return redirect('/universidades');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $universidad=Universidade::Find($id);
        $universidad->estado=0;
        $universidad->save();
        Session::flash('flash_message', 'Se eliminó correctamente la Universidad!!');
        return redirect('/universidades');
    }
}
