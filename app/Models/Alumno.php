<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\TipoDocumento;
use App\Models\Apoderado;
use App\Models\Tipoapoderado;
use App\Models\SituacionLaboral;
use App\Models\RegistroSalud;
use App\Models\Controles;
use App\Models\Domicilio;

class Alumno extends Model
{
    use HasFactory;

    
    protected $table = 'alumnos';
    protected $fillable = ['tipo_documento_id',
                            'num_documento',
                            'apellido_paterno',
                            'apellido_materno',
                            'nombres',
                            'fecha_nacimiento',
                            'genero',
                            'grado_actual',
                            'nivel_actual',
                            'telefono',
                            'direccion',
                            'correo',
                            'pais',
                            'sigla_pais',
                            'departamento',
                            'provincia',
                            'distrito',
                            'lugar',
                            'lengua_materna',
                            'segunda_lengua',
                            'num_hermanos',
                            'lugar_hermano',
                            'religion',
                            'DI',
                            'DA',
                            'DV',
                            'nacimiento',
                            'obs_nacimiento',
                            'levanto_cabeza',
                            'se_sento',
                            'se_paro',
                            'se_camino',
                            'se_control_esfinter',
                            'se_primeras_palabras',
                            'se_hablo_fluido',
                            'nacimiento_registrado',
                            'activo',
                            'borrado',
                            'estado_grado',
                            'DM',
                            'SC',
                            'OT',
                            'user_id',
                            'pais_id',
                            'departamento_id',
                            'provincia_id',
                            'distrito_id',
                        ];
	protected $guarded = ['id'];

    public static function GetByDocIdentidad($tipo_documento_id, $num_documento){
        $data = Alumno::where('tipo_documento_id', $tipo_documento_id)
                    ->where('num_documento', $num_documento)
                    ->first();
                    

        if($data){
            $tipoDocumento = TipoDocumento::find($data->tipo_documento_id);
            $data->tipoDocumento = $tipoDocumento;

            $apoderados = Apoderado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->get();

                                foreach ($apoderados as $key => $apoderado) {
                                    $tipoApoderado = Tipoapoderado::find($apoderado->tipo_apoderado_id);
                                    $apoderado->tipoApoderado = $tipoApoderado;
                                }
            $data->apoderados = $apoderados;

            $traslados = Traslado::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->get();
            $data->traslados = $traslados;

            $situacionLaboral = SituacionLaboral::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->first();
            $data->situacionLaboral = $situacionLaboral;

            $registroSalud = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->first();
            $data->registroSalud = $registroSalud;

            $controles = Controles::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->get();
            $data->controles = $controles;

            $domicilios = Domicilio::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderByDesc('id')
                                ->get();
            $data->domicilios = $domicilios;

            $data->fullNombre = $data->apellido_paterno . ' ' . $data->apellido_materno . ' ' . $data->nombres;
        }
        

        return $data;
    }
}
