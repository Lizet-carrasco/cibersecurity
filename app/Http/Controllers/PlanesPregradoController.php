<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

use App\Models\Planes_pregrado;
use App\Models\Escuela;
use App\Models\Facultade;
use App\Models\Tema;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PlanesPregradoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $model= new Planes_pregrado();
        $planes_temas=$model->ShowPlanesByEscuelaId($id);
        $contador=$model->CountPlanesByEscuelaId($id);
        $universidad=$model->GetUniversidadByEscuelaId($id);
        $escuela= Escuela::Find($id);
        $model_temas=new Tema();
        $temas=$model_temas->AllTemas();
        //$temas=Tema::All();
        return view('backend.planes_temas.index', compact('planes_temas','escuela','contador','temas','universidad')); 
        
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
        $plan = new Planes_pregrado();
        $plan->tema_id=$request->tema_id;
        $plan->escuela_id=$request->escuela_id;
        $plan->nombre=$request->nombre;
        $plan->enlace_plan=$request->enlace_plan;
        $plan->periodo_inicio=$request->periodo_inicio;
        $plan->periodo_fin=$request->periodo_fin;
        $plan->vigencia=1;
        $plan->estado=1;
        $plan->curso=$request->cursos;
        $plan->save();
        Session::flash('flash_message', 'Se registró correctamente el plan relacionado al tema seleccionado!!');
        return redirect('/planes_temas/'.$request->escuela_id);
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
        $model=new Planes_pregrado();
        $plan= $model->GetPlanByIdPlan($id);
        $universidad=$model->GetUniversidadByPlanId($id);
        $escuela=$model->GetEscuelaByPlanId($id);
        //var_dump($universidad); exit();
        $temas=Tema::all();
        return view('backend.planes_temas.edit', compact('plan','temas','universidad','escuela'));
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
        $plan=Planes_pregrado::Find($request->id);
        $plan->escuela_id=$request->escuela_id;
        $plan->tema_id=$request->tema_id;
        $plan->nombre=$request->nombre;
        $plan->enlace_plan=$request->enlace_plan;
        $plan->curso=$request->curso;
        $plan->periodo_inicio=$request->periodo_inicio;
        $plan->periodo_fin=$request->periodo_fin;

        $plan->save();
        Session::flash('flash_message', 'Se actualizó correctamente el plan relacionado al tema seleccionado!!');
        return redirect('/planes_temas/'.$request->escuela_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $plan=Planes_pregrado::Find($id);
        $plan->estado=0;
        $plan->save();
     

        Session::flash('flash_message', 'Se eliminó correctamente el plan relacionado al tema seleccionado!!');
        return redirect('/planes_temas/'.$plan->escuela_id);
    }
}
