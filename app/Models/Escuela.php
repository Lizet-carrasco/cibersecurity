<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Escuela extends Model
{
    public function ShowEscuelasByFacultadId($id){        
        $datos=DB::table('escuelas')
        ->where('escuelas.estado','=',1)
        ->where('escuelas.facultad_id','=',$id)
        ->orderBy('escuelas.nombre','asc')
        ->select('escuelas.*')
        ->get();
    return $datos;
    }

    public function GetUniversidadByFacultadId($id){
        $datos=DB::table('facultades')
        ->join('universidades','facultades.universidad_id','=','universidades.id')
        ->where('facultades.estado','=',1)
        ->where('facultades.id','=',$id)
        ->select('universidades.*')
        ->first();
    return $datos;
    }

    public function CountEscuelasByFacultadId($id){        
        $datos=DB::table('escuelas')
        ->where('escuelas.estado','=',1)
        ->where('escuelas.facultad_id','=',$id)
        ->orderBy('escuelas.nombre','asc')
        ->select('escuelas.*')
        ->count();
    return $datos;
    }

    public function ShowPlanesByEscuelaId($id){        
        $datos=DB::table('planes_pregrados')
        ->join('escuelas','planes_pregrados.escuela_id','=','escuelas.id')
        ->join('temas','planes_pregrados.tema_id','=','temas.id')
        ->where('planes_pregrados.estado','=',1)
        ->where('planes_pregrados.escuela_id','=',$id)
        ->orderBy('planes_pregrados.nombre','asc')
        ->select('planes_pregrados.*','temas.nombre as tema','escuelas.nombre as escuela','escuelas.sigla')
        ->get();
    return $datos;
    }
}
