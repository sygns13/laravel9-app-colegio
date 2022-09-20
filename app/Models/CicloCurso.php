<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\CicloCurso;

class CicloCurso extends Model
{
    use HasFactory;

    protected $table = 'ciclo_cursos';
    protected $fillable = ['nombre',
                            'orden',
                            'ciclo_grado_id',
                            'curso_id',
                            'opcion',
                            'activo',
                            'borrado',
                            'ciclo_escolar_id',
                            'docente_id',
                        ];
	protected $guarded = ['id'];

    public static function GetCursoByCicloAndCurso($ciclo_id, $curso_id){
        $data = CicloCurso::where('ciclo_escolar_id', $ciclo_id)
                    ->where('curso_id', $curso_id)
                    ->first();

        return $data;
    }

    public static function GetCicloCursosActivos(){

        $cicloActivo = CicloEscolar::GetCicloActivo();

        $data = [];

        if($cicloActivo){

            $data = CicloCurso::where('borrado','0')
            ->where('activo','1')
            ->where('ciclo_escolar_id', $cicloActivo->id)
            ->orderBy('ciclo_grado_id')
            ->orderBy('orden')
            ->get();

        }

        return $data;

    }
}
