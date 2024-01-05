<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Universidad;
use App\Models\Facultade;
use App\Models\Universidade;
use App\Models\Escuela;

class EscuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $model= new Escuela();
        $escuelas=$model->ShowEscuelasByFacultadId($id);
       //var_dump($escuelas); exit;
        $universidad=$model->GetUniversidadByFacultadId($id);
        $contador=$model->CountEscuelasByFacultadId($id);
        $facultad= Facultade::Find($id);
        return view('backend.escuelas.index', compact('escuelas','facultad','contador','universidad')); 
    }

    public function escuelas($id)
    {
        $model= new Escuela();
        $escuelas=$model->ShowPlanesByEscuelaId($id);
       //var_dump($escuelas); exit;
        $universidad=$model->GetUniversidadByFacultadId($id);
        $contador=$model->CountEscuelasByFacultadId($id);
        $facultad= Facultade::Find($id);
        return view('frontend.universidades.escuelas', compact('escuelas','facultad','contador','universidad')); 
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
        $escuela = new Escuela();
        $escuela->nombre=$request->nombre;
        $escuela->sigla=$request->sigla;
        $escuela->facultad_id=$request->facultad_id;
        $escuela->estado=1;
        $escuela->save();
        Session::flash('flash_message', 'Se registró correctamente la Escuela!!');
        return redirect('/escuelas/'.$request->facultad_id);
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
        $escuela=Escuela::Find($id);
        return view('backend.escuelas.edit', compact('escuela'));
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
        $escuela=Escuela::Find($request->id);
        $escuela->nombre=$request->nombre;
        $escuela->sigla=$request->sigla;
        $escuela->save();
        Session::flash('flash_message', 'Se actualizó correctamente la escuela!!');
        return redirect('/escuelas/'.$request->facultad_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $escuela=Escuela::Find($id);
        $escuela->estado=0;
        $escuela->save();
        Session::flash('flash_message', 'Se eliminó correctamente la escuela!!');
        return redirect('/escuelas/'.$escuela->facultad_id);
    }
}
