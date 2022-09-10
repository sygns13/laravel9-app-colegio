<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Grado;
use App\Models\CicloGrado;
use App\Models\CicloNivel;
use stdClass;

class CicloSeccion extends Model
{
    use HasFactory;

    protected $table = 'ciclo_seccion';
    protected $fillable = ['nombre',
                            'sigla',
                            'seccion_id',
                            'ciclo_grados_id',
                            'turno_id',
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

    public static function GetSeccionsByCicloAndGradoMaster($ciclo_id, $gradoMaster_id){

        $cicloGrado = CicloGrado::GetGradoByCicloAndGrado($ciclo_id, $gradoMaster_id);

        if(!$cicloGrado){
            return [];
        }

        $cicloNivel = CicloNivel::find($cicloGrado->ciclo_niveles_id);
        $turno = "";
        if($cicloNivel != null){
            $turno = Turno::find($cicloNivel->turno_id);
            $turno = $turno->nombre;
        }

        $data = CicloSeccion::where('ciclo_escolar_id', $ciclo_id)
                    ->where('ciclo_grados_id', $cicloGrado->id)
                    ->where('activo', 1)
                    ->where('borrado', 0)
                    ->get();
        
        $response = new stdClass();
        $response->secciones = $data;
        $response->turno = $turno;

        return $response;
    }
}
