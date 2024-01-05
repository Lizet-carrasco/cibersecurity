<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    public function AllTemas(){
        $datos=DB::table('temas')
            ->where('temas.estado','=',1)
            ->orderBy('temas.nombre','asc')
            ->select('temas.*')
            ->get();
        return $datos;
    }


    public function CountTemas(){
        $datos=DB::table('temas')
            ->where('temas.estado','=',1)
            ->select('temas.*')
            ->count();
        return $datos;
    }


    public function DepartamentoPosgrado($tema_id, $tipo, $departamento){
        $datos=DB::table('planes_posgrados')        
            ->join('temas','planes_posgrados.tema_id','=','temas.id')
            ->join('posgrados','planes_posgrados.posgrado_id','=','posgrados.id')
            ->join('universidades','posgrados.universidad_id','=','universidades.id')            
            ->where('planes_posgrados.estado','=',1)
            ->where('planes_posgrados.tema_id','=',$tema_id)
            ->where('posgrados.tipo','=',$tipo)
            ->where('universidades.departamento','=',$departamento)
            ->count();
        return $datos;
    }

    public function UniversidadesOfDepartamenPosgrado($tema_id, $tipo, $departamento){
        $datos=DB::table('planes_posgrados')        
            ->join('temas','planes_posgrados.tema_id','=','temas.id')
            ->join('posgrados','planes_posgrados.posgrado_id','=','posgrados.id')
            ->join('universidades','posgrados.universidad_id','=','universidades.id')            
            ->where('planes_posgrados.estado','=',1)
            ->where('planes_posgrados.tema_id','=',$tema_id)
            ->where('posgrados.tipo','=',$tipo)
            ->where('universidades.departamento','=',$departamento)
            ->select('universidades.*','planes_posgrados.enlace_plan')
            ->get();
        return $datos;
    }



    
    public function AyacuchoPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"AYACUCHO")
            ->count();

        //var_dump($datos); exit();
        return $datos;
    }

    public function UniversidadesOfAyacuchoPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"AYACUCHO")
            ->select('universidades.*','planes_pregrados.enlace_plan')
            ->get();
        return $datos;
    }

    
    public function HuanucoPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"HUÁNUCO")
            ->count();

        //var_dump($datos); exit();
        return $datos;
    }

    public function UniversidadesOfHuanucoPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"HUÁNUCO")
            ->select('universidades.*','planes_pregrados.enlace_plan')
            ->get();
        return $datos;
    }

    


    public function JuninPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"JUNIN")
            ->count();
        return $datos;
    }

    public function UniversidadesOfJuninPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"JUNIN")
            ->select('universidades.*','planes_pregrados.enlace_plan')
            ->get();
        return $datos;
    }

    

    public function PascoPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"PASCO")
            ->count();
        return $datos;
    }

    public function UniversidadesOfPascoPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"PASCO")
            ->select('universidades.*','planes_pregrados.enlace_plan')
            ->get();
        return $datos;
    }
    




    public function HuancavelicaPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"HUANCAVELICA")
            ->count();
        return $datos;
    }

    public function UniversidadesOfHuancavelicaPregrado($tema_id){
        $datos=DB::table('planes_pregrados')        
            ->join('temas','planes_pregrados.tema_id','=','temas.id')
            ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
            ->join('facultades','escuelas.facultad_id','=','facultades.id')
            ->join('universidades','facultades.universidad_id','=','universidades.id')            
            ->where('planes_pregrados.estado','=',1)
            ->where('planes_pregrados.tema_id','=',$tema_id)
            ->where('universidades.departamento','=',"HUANCAVELICA")
            ->select('universidades.*','planes_pregrados.enlace_plan')
            ->get();
        return $datos;
    }


}
