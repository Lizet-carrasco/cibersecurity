<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Tema;

class MapaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Tema();
        $temas=$model->AllTemas();
        return view('backend.mapas.index',compact('temas')); 
    }

    public function edusys(){
        return view('frontend.edusys.index');
        
    }

    public function index_frontend()
    {
        $model=new Tema();
        $temas=$model->AllTemas();
        return view('frontend.mapas.index',compact('temas')); 
    }


    public function buscar_tema_frontend (Request $request){

       // var_dump($request->tema_id); exit;
        if($request->tipo_nivel==1){
            $model = new Tema();
            $ayacuchoPregrado=$model->AyacuchoPregrado($request->tema_id);
            $huanucoPregrado=$model->HuanucoPregrado($request->tema_id);
            $juninPregrado=$model->JuninPregrado($request->tema_id);
            $pascoPregrado=$model->PascoPregrado($request->tema_id);
            $huancavelicaPregrado=$model->HuancavelicaPregrado($request->tema_id);
            $tema=Tema::Find($request->tema_id);

            $universidades_ayacucho=$model->UniversidadesOfAyacuchoPregrado($request->tema_id);
            $universidades_huanuco=$model->UniversidadesOfHuanucoPregrado($request->tema_id);
            $universidades_pasco=$model->UniversidadesOfPascoPregrado($request->tema_id);
            $universidades_junin=$model->UniversidadesOfJuninPregrado($request->tema_id);
            $universidades_huancavelica=$model->UniversidadesOfHuancavelicaPregrado($request->tema_id);

            //var_dump($huanucoPregrado, $universidades_huanuco); exit;
    
            return view('frontend.mapas.mapa',compact('ayacuchoPregrado','juninPregrado','huanucoPregrado','pascoPregrado','huancavelicaPregrado',
                        'tema','universidades_ayacucho','universidades_huanuco','universidades_pasco','universidades_junin','universidades_huancavelica')); 
        }else{
            $model = new Tema();
            $ayacuchoPosgrado=$model->DepartamentoPosgrado($request->tema_id, $request->tipo,"Ayacucho");
            $huanucoPosgrado=$model->DepartamentoPosgrado($request->tema_id, $request->tipo,"Huánuco");
            $juninPosgrado=$model->DepartamentoPosgrado($request->tema_id, $request->tipo,"Junin");
            $pascoPosgrado=$model->DepartamentoPosgrado($request->tema_id, $request->tipo,"Pasco");
            $huancavelicaPosgrado=$model->DepartamentoPosgrado($request->tema_id, $request->tipo,"Huancavelica");
            //var_dump($ayacuchoPosgrado, $huanucoPosgrado, $juninPosgrado, $pascoPosgrado, $huancavelicaPosgrado); exit;
            $tema=Tema::Find($request->tema_id);
            $universidades_ayacucho=$model->UniversidadesOfDepartamenPosgrado($request->tema_id, $request->tipo,"Ayacucho");
            $universidades_huanuco=$model->UniversidadesOfDepartamenPosgrado($request->tema_id, $request->tipo,"Huánuco");
            $universidades_pasco=$model->UniversidadesOfDepartamenPosgrado($request->tema_id, $request->tipo,"Pasco");
            $universidades_junin=$model->UniversidadesOfDepartamenPosgrado($request->tema_id, $request->tipo,"Junin");
            $universidades_huancavelica=$model->UniversidadesOfDepartamenPosgrado($request->tema_id, $request->tipo,"Huancavelica");
            //var_dump($universidades_ayacucho,$universidades_huanuco, $universidades_pasco, $universidades_junin, $huancavelicaPosgrado); exit;
            $tipo=$request->tipo;
            return view('frontend.mapas.posgrado',compact('ayacuchoPosgrado','huanucoPosgrado','juninPosgrado','pascoPosgrado','huancavelicaPosgrado',
            'universidades_ayacucho','universidades_huanuco','universidades_pasco','universidades_junin','universidades_huancavelica','tema','tipo'));
        }

    }

    public function buscar_tema(Request $request){
        //var_dump($request->tema_id); exit;
        $model = new Tema();
        $ayacuchoPregrado=$model->AyacuchoPregrado($request->tema_id);
        $huanucoPregrado=$model->HuanucoPregrado($request->tema_id);
        $juninPregrado=$model->JuninPregrado($request->tema_id);
        $pascoPregrado=$model->PascoPregrado($request->tema_id);
        $huancavelicaPregrado=$model->HuancavelicaPregrado($request->tema_id);
        $tema=Tema::Find($request->tema_id);

        $universidades_ayacucho=$model->UniversidadesOfAyacuchoPregrado($request->tema_id);
        $universidades_huanuco=$model->UniversidadesOfHuanucoPregrado($request->tema_id);
        $universidades_pasco=$model->UniversidadesOfPascoPregrado($request->tema_id);
        $universidades_junin=$model->UniversidadesOfJuninPregrado($request->tema_id);
        $universidades_huancavelica=$model->UniversidadesOfHuancavelicaPregrado($request->tema_id);

        //$juninPregrado=2;
        return view('backend.mapas.mapa',compact('ayacuchoPregrado','juninPregrado','huanucoPregrado','pascoPregrado','huancavelicaPregrado',
        'tema','universidades_ayacucho','universidades_huanuco','universidades_pasco','universidades_junin','universidades_huancavelica')); 
        
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
        //
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
