<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloIndicador extends Model
{
    use HasFactory;

    protected $table = 'ciclo_indicadores';
    protected $fillable = ['nombre',
                            'orden',
                            'indicador_id',
                            'ciclo_competencia_id',
                            'activo',
                            'borrado',
                            'ciclo_escolar_id',
                            'fecha_programada1',
                            'hora_programada1',
                            'fecha_programada2',
                            'hora_programada2',
                            'fecha_programada3',
                            'hora_programada3',
                            'fecha_programada4',
                            'hora_programada4',
                        ];
	protected $guarded = ['id'];

    public static function GetIndicadorByCicloAndIndicador($ciclo_id, $indicador_id){
        $data = CicloIndicador::where('ciclo_escolar_id', $ciclo_id)
                    ->where('indicador_id', $indicador_id)
                    ->first();

        return $data;
    }
}
