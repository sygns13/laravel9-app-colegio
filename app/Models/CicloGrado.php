<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CicloGrado extends Model
{
    use HasFactory;

    protected $table = 'ciclo_grados';
    protected $fillable = ['grado_id',
                            'nombre',
                            'ciclo',
                            'orden',
                            'ciclo_niveles_id',
                            'activo',
                            'borrado',
                            'ciclo_escolar_id',
                        ];
	protected $guarded = ['id'];

    public static function GetGradoByCicloAndGrado($ciclo_id, $grado_id){
        $data = CicloGrado::where('ciclo_escolar_id', $ciclo_id)
                                    ->where('grado_id', $grado_id)
                                    ->first();

        return $data;
    }
}
