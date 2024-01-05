<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Facultade extends Model
{
    public function ShowFacultadesByIdUniversidad($id){        
        $datos=DB::table('facultades')
        ->where('facultades.estado','=',1)
        ->where('facultades.universidad_id','=',$id)
        ->orderBy('facultades.nombre','asc')
        ->select('facultades.*')
        ->get();
    return $datos;
    }

    public function CountFacultadesByIdUniversidad($id){        
        $datos=DB::table('facultades')
        ->where('facultades.estado','=',1)
        ->where('facultades.universidad_id','=',$id)
        ->orderBy('facultades.nombre','asc')
        ->select('facultades.*')
        ->count();
    return $datos;
    }

    
}
