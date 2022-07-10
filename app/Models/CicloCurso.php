<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
                        ];
	protected $guarded = ['id'];

    public static function GetCursoByCicloAndCurso($ciclo_id, $curso_id){
        $data = CicloCurso::where('ciclo_escolar_id', $ciclo_id)
                    ->where('curso_id', $curso_id)
                    ->first();

        return $data;
    }
}
