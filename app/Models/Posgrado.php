<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Posgrado extends Model
{
    public function ShowPosgradosByIdUniversidad($id){        
        $datos=DB::table('posgrados')
        ->where('posgrados.estado','=',1)
        ->where('posgrados.universidad_id','=',$id)
        ->orderBy('posgrados.nombre_completo','asc')
        ->select('posgrados.*')
        ->get();
    return $datos;
    }

    public function CountPosgradosByIdUniversidad($id){        
        $datos=DB::table('posgrados')
        ->where('posgrados.estado','=',1)
        ->where('posgrados.universidad_id','=',$id)
        ->orderBy('posgrados.nombre_completo','asc')
        ->select('posgrados.*')
        ->count();
    return $datos;
    }
}
