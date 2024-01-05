<?php

namespace App\Models;
use DB;
use Illuminate\Database\Eloquent\Model;

class Planes_posgrado extends Model
{
    public function temaAsociadoPosgardo($posgrado_id){
        $datos=DB::table('planes_posgrados')
        ->join('posgrados','planes_posgrados.posgrado_id','=','posgrados.id')
        ->join('temas','planes_posgrados.tema_id','=','temas.id')
        ->where('planes_posgrados.estado','=',1)
        ->where('planes_posgrados.posgrado_id','=',$posgrado_id)
        ->orderBy('planes_posgrados.nombre','asc')
        ->select('planes_posgrados.*','temas.nombre as tema','posgrados.nombre_completo as posgrado','posgrados.tipo')
        ->get();
    return $datos;
    }

    public function contadoTemaAsociadoPosgardo($posgrado_id){
        $datos=DB::table('planes_posgrados')
        ->join('posgrados','planes_posgrados.posgrado_id','=','posgrados.id')
        ->join('temas','planes_posgrados.tema_id','=','temas.id')
        ->where('planes_posgrados.estado','=',1)
        ->where('planes_posgrados.posgrado_id','=',$posgrado_id)
        ->count();
    return $datos;
    }

    public function GetPlanByIdPlanPosgrado($id){
        $datos=DB::table('planes_posgrados')
        ->join('posgrados','planes_posgrados.posgrado_id','=','posgrados.id')
        ->join('temas','planes_posgrados.tema_id','=','temas.id')
        ->where('planes_posgrados.estado','=',1)
        ->where('planes_posgrados.id','=',$id)
        ->orderBy('planes_posgrados.nombre','asc')
        ->select('planes_posgrados.*','temas.nombre as tema','posgrados.nombre_completo as posgrado')
        ->first();
        //var_dump($datos); exit;
    return $datos;
    }
}
