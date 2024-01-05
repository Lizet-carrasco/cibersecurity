<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Session;
use App\Models\Universidad;
use App\Models\Facultade;
use App\Models\Universidade;

class FacultadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $model= new Facultade();
        $facultades=$model->ShowFacultadesByIdUniversidad($id);
       // var_dump($facultades); exit;
        $contador=$model->CountFacultadesByIdUniversidad($id);
        $universidad= Universidade::Find($id);
        return view('backend.facultades.index', compact('facultades','universidad','contador')); 
    }


    public function facultades($id)
    {
        $model= new Facultade();
        $facultades=$model->ShowFacultadesByIdUniversidad($id);
       // var_dump($facultades); exit;
        $contador=$model->CountFacultadesByIdUniversidad($id);
        $universidad= Universidade::Find($id);
        return view('frontend.universidades.facultades', compact('facultades','universidad','contador')); 
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
        $facultad = new Facultade();
        $facultad->nombre=$request->nombre;
        $facultad->sigla=$request->sigla;
        $facultad->universidad_id=$request->universidad_id;
        $facultad->estado=1;
        $facultad->save();
        Session::flash('flash_message', 'Se registró correctamente la Facultad!!');
        return redirect('/facultades/'.$request->universidad_id);
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
        
            $facultad=Facultade::Find($id);
            return view('backend.facultades.edit', compact('facultad'));
        
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
        $facultad=Facultade::Find($request->id);
        $facultad->nombre=$request->nombre;
        $facultad->sigla=$request->sigla;
        $facultad->save();
        Session::flash('flash_message', 'Se actualizó correctamente la facultad!!');
        return redirect('/facultades/'.$request->universidad_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $facultad=Facultade::Find($id);
        $facultad->estado=0;
        $facultad->save();
        Session::flash('flash_message', 'Se eliminó correctamente la facultad!!');
        return redirect('/facultades/'.$facultad->universidad_id);
    }
}
