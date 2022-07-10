<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloSeccion extends Model
{
    use HasFactory;

    protected $table = 'ciclo_seccion';
    protected $fillable = ['nombre',
                            'sigla',
                            'seccion_id',
                            'ciclo_grados_id',
                            'turno',
                            'activo',
                            'borrado',
                            'ciclo_escolar_id',
                        ];
	protected $guarded = ['id'];


    public static function GetSeccionByCicloAndSeccion($ciclo_id, $seccion_id){
        $data = CicloSeccion::where('ciclo_escolar_id', $ciclo_id)
                    ->where('seccion_id', $seccion_id)
                    ->first();

        return $data;
    }
}
