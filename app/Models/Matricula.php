<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Traslado;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';
    protected $fillable = ['alumno_id',
                            'ciclo_escolar_id',
                            'fecha',
                            'estado',
                            'es_traslado',
                            'tiene_discapacidad',
                            'vive_madre',
                            'vive_padre',
                            'responsable_matricula_nombres',
                            'cargo_responsable',
                            'ciclo_seccion_id',
                            'situacion_final',
                            'nota_final',
                            'situacion',
                            'sigla_situacion',
                            'trabaja',
                            'activo',
                            'borrado',
                            'created_at',
                            'updated_at',
                            'DI',
                            'DA',
                            'DV',
                            'DM',
                            'SC',
                            'OT',
                        ];
	protected $guarded = ['id'];

    public static function GetMatriculasByCicloAndAlumno($ciclo_id, $alumno_id){

        $matricula = Matricula::where('ciclo_escolar_id', $ciclo_id)
                                ->where('alumno_id', $alumno_id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->first();
        
        if(!$matricula){
            return null;
        }

        $traslado = Traslado::where('alumno_id', $alumno_id)
                    ->where('matricula_id', $matricula->id)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->first();

        if(!$traslado){
            $matricula->es_traslado = 0;
            $matricula->traslado = null;

            return $matricula;
        }

        $matricula->es_traslado = 1;
        $matricula->traslado = $traslado;

        return $matricula;
    }
}
