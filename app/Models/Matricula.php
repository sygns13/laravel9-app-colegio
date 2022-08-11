<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    use HasFactory;

    protected $table = 'matriculas';
    protected $fillable = ['alumno_id',
                            'ciclo_escolar_id',
                            'fecha',
                            'estado',
                            'anio_ingreso',
                            'es_traslado',
                            'codigo_modular_traslado',
                            'rj_rd_traslado',
                            'resolucion_traslado',
                            'numero_matricula',
                            'flag',
                            'tiene_discapacidad',
                            'vive_madre',
                            'vive_padre',
                            'apoderado_id',
                            'responsable_matricula_nombres',
                            'cargo_responsable',
                            'ciclo_seccion_id',
                            'situacion_final',
                            'nota_final',
                            'situacion',
                            'sigla_situacion',
                            'trabaja',
                            'horas_semana_trabaja',
                            'escolaridad_madrie',
                            'sigla_escolaridad',
                            'activo',
                            'borrado'
                        ];
	protected $guarded = ['id'];
}
