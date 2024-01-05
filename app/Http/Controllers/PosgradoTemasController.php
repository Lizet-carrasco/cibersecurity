<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Session;

use App\Models\Planes_posgrado;
use App\Models\Universidade;
use App\Models\Posgrado;
use App\Models\Tema;


use App\Http\Requests;
use App\Http\Controllers\Controller;

class PosgradoTemasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($posgrado_id)
    {
        $posgrado=Posgrado::Find($posgrado_id);
        $model_tema=new Tema();
        $temas=$model_tema->AllTemas();
        $model=new Planes_posgrado();
        $planes=$model->temaAsociadoPosgardo($posgrado_id);
        $contador=$model->contadoTemaAsociadoPosgardo($posgrado_id);
        return view('backend.posgrado_temas.index',compact('contador','posgrado','temas','planes')); 
    }

    public function posgrados($posgrado_id)
    {
       //var_dump("Hola"); exit;
        $model=new Planes_posgrado();
        $contador=$model->contadoTemaAsociadoPosgardo($posgrado_id);
        if($contador>0){
            $posgrado=Posgrado::Find($posgrado_id);
            $variable=$posgrado->universidad_id;
            $universidad=Universidade::Find($variable);
            $model_tema=new Tema();
            $temas=$model_tema->AllTemas();
            
            $planes=$model->temaAsociadoPosgardo($posgrado_id);
            return view('frontend.universidades.posgrado',compact('contador','posgrado','temas','planes','universidad')); 
        }else{            
            return view('frontend.universidades.sinposgrados'); 
        }
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
        $plan=new Planes_posgrado();
        $plan->posgrado_id=$request->posgrado_id;
        $plan->tema_id=$request->tema_id;
        $plan->nombre=$request->nombre;
        $plan->periodo_inicio=$request->periodo_inicio;
        $plan->periodo_fin=$request->periodo_fin;
        $plan->enlace_plan=$request->enlace_plan;
        $plan->cursos=$request->cursos;
        $plan->estado=1;
        $plan->vigencia=1;
        $plan->save();
        Session::flash('flash_message', 'Se registró correctamente el plan relacionado al tema seleccionado!!');
        return redirect('/posgrado_tema/'.$request->posgrado_id);

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
        $model=new Planes_posgrado();
        $plan= $model->GetPlanByIdPlanPosgrado($id);
        $temas=Tema::all();
        $posgrado=Posgrado::Find($plan->posgrado_id);

        return view('backend.posgrado_temas.edit', compact('plan','temas','posgrado'));
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
        $plan= Planes_posgrado::Find($request->id);
        $plan->tema_id=$request->tema_id;
        $plan->nombre=$request->nombre;
        $plan->enlace_plan=$request->enlace_plan;
        $plan->periodo_inicio=$request->periodo_inicio;
        $plan->periodo_fin=$request->periodo_fin;
        $plan->cursos=$request->cursos;
        $plan->save();
        Session::flash('flash_message', 'Se actualizó correctamente el plan relacionado al tema seleccionado!!');
        return redirect('/posgrado_tema/'.$request->posgrado_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $plan=Planes_posgrado::Find($id);
        $plan->estado=0;
        $plan->save();
        Session::flash('flash_message', 'Se eliminó correctamente el plan relacionado al tema seleccionado!!');
        return redirect('/posgrado_tema/'.$plan->posgrado_id);
    }
}
