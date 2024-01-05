<?php

namespace App\Models;
use DB;

use Illuminate\Database\Eloquent\Model;

class Universidade extends Model
{
    public function AllUniversidadesActivos(){
            $datos=DB::table('universidades')
            ->where('universidades.estado','=',1)
            ->orderBy('universidades.nombre','asc')
            ->select('universidades.*')
            ->get();
        return $datos;
    }
}
