<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloCompetencia extends Model
{
    use HasFactory;

    protected $table = 'ciclo_competencias';
    protected $fillable = ['nombre',
                            'orden',
                            'competencia_id',
                            'ciclo_cursos_id',
                            'activo',
                            'borrado',
                            'ciclo_escolar_id',
                        ];
	protected $guarded = ['id'];

    public static function GetCompetenciaByCicloAndCompetencia($ciclo_id, $competencia_id){
        $data = CicloCompetencia::where('ciclo_escolar_id', $ciclo_id)
                    ->where('competencia_id', $competencia_id)
                    ->first();

        return $data;
    }
}
