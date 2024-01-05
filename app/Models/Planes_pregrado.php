<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Planes_pregrado extends Model
{
    public function ShowPlanesByEscuelaId($id){        
        $datos=DB::table('planes_pregrados')
        ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
        ->join('temas','planes_pregrados.tema_id','=','temas.id')
        ->where('planes_pregrados.estado','=',1)
        ->where('planes_pregrados.escuela_id','=',$id)
        ->orderBy('planes_pregrados.nombre','asc')
        ->select('planes_pregrados.*','temas.nombre as tema','escuelas.nombre as escuela')
        ->get();
    return $datos;
    }

    public function CountPlanesByEscuelaId($id){      

        $datos=DB::table('planes_pregrados')
        ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
        ->join('temas','planes_pregrados.tema_id','=','temas.id')
        ->where('planes_pregrados.estado','=',1)
        ->where('planes_pregrados.escuela_id','=',$id)
        ->orderBy('planes_pregrados.nombre','asc')
        ->select('planes_pregrados.*','temas.nombre as tema','escuelas.nombre as escuela')
        ->count();
    return $datos;
    }

    public function GetPlanByIdPlan($id){
        $datos=DB::table('planes_pregrados')
        ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
        ->join('temas','planes_pregrados.tema_id','=','temas.id')
        ->where('planes_pregrados.estado','=',1)
        ->where('planes_pregrados.id','=',$id)
        ->select('planes_pregrados.*','temas.nombre as tema','escuelas.nombre as escuela')
        ->first();
    return $datos;
    }

    public function GetUniversidadByEscuelaId($id){
        $datos=DB::table('escuelas')
        ->join('facultades','escuelas.facultad_id','=','facultades.id')
        ->join('universidades','facultades.universidad_id','=','universidades.id')
        ->where('escuelas.estado','=',1)
        ->where('escuelas.id','=',$id)
        ->select('universidades.*')
        ->first();
    return $datos;
    }

    public function GetUniversidadByPlanId($id){
        $datos=DB::table('planes_pregrados')
        ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
        ->join('facultades','escuelas.facultad_id','=','facultades.id')
        ->join('universidades','facultades.universidad_id','=','universidades.id')
        ->where('planes_pregrados.estado','=',1)
        ->where('planes_pregrados.id','=',$id)
        ->select('universidades.*')
        ->first();
    return $datos;
    }

    public function GetEscuelaByPlanId($id){
        $datos=DB::table('planes_pregrados')
        ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
        ->where('planes_pregrados.estado','=',1)
        ->where('planes_pregrados.id','=',$id)
        ->select('escuelas.*')
        ->first();
       // var_dump($datos); exit();
    return $datos;
    }
}
