<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocenteAsistenciaDia extends Model
{
    use HasFactory;

    protected $table = 'docentes_asistencias_dias';
    protected $fillable = ['fecha',
                            'ciclo_escolar_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetDocenteAsistenciaDiaActive(){

        $fecha = date('Y-m-d');
        $registro = DocenteAsistenciaDia::where('fecha',$fecha)
                    ->where('activo','1')
                    ->where('borrado','0')
                    ->first();

        return $registro;
    }

    public static function GetDocenteAsistenciaDiaByDate($date){

        $registro = DocenteAsistenciaDia::where('fecha',$date)
                    ->where('activo','1')
                    ->where('borrado','0')
                    ->first();

        return $registro;
    }
}
