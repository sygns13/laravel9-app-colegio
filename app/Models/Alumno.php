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
use App\Models\Matricula;
use App\Models\CicloEscolar;
use App\Models\CicloSeccion;
use App\Models\CicloGrado;
use App\Models\CicloNivel;
use App\Models\Turno;
use App\Models\ApoderadoMatricula;

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
                            'celular',
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
                            'anio_ingreso',
                            'codigo_modular',
                            'numero_matricula',
                            'flag',
                            'old_estado_grado',
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

    public static function GetById($alumno_id){
        $data = Alumno::findOrFail($alumno_id);
                    

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
                                ->orderBy('id')
                                ->get();
            $data->traslados = $traslados;

            $situacionLaborales = SituacionLaboral::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();
            $data->situacionLaborales = $situacionLaborales;

            $registroSaludEnfermedads = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 1)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludEnfermedads = $registroSaludEnfermedads;

            $registroSaludVacunas = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 2)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludVacunas = $registroSaludVacunas;

            $registroSaludAlergias = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 3)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludAlergias = $registroSaludAlergias;

            $registroSaludExperienciasT = RegistroSalud::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo', 4)
                                ->orderBy('id')
                                ->get();
            $data->registroSaludExperienciasT = $registroSaludExperienciasT;

            $controlesPesoTalla = Controles::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo_control', 1)
                                ->orderBy('id')
                                ->get();
            $data->controlesPesoTalla = $controlesPesoTalla;

            $controlesOtros = Controles::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->where('tipo_control', 2)
                                ->orderBy('id')
                                ->get();
            $data->controlesOtros = $controlesOtros;

            $domicilios = Domicilio::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();
            $data->domicilios = $domicilios;

            $matriculas = Matricula::where('alumno_id', $data->id)
                                ->where('activo', 1)
                                ->where('borrado', 0)
                                ->orderBy('id')
                                ->get();

                                foreach ($matriculas as $keyC => $matricula) {
                                    $ciclo = CicloEscolar::find($matricula->ciclo_escolar_id);
                                    $matricula->ciclo = $ciclo;

                                    $cicloSeccion = CicloSeccion::find($matricula->ciclo_seccion_id);
                                    $matricula->cicloSeccion = $cicloSeccion;

                                    $turno = Turno::find($cicloSeccion->turno_id);
                                    $matricula->turno = $turno;

                                    $cicloGrado = CicloGrado::find($cicloSeccion->ciclo_grados_id);
                                    $matricula->cicloGrado = $cicloGrado;

                                    $cicloNivel = CicloNivel::find($cicloGrado->ciclo_niveles_id);
                                    $matricula->cicloNivel = $cicloNivel;

                                    $apoderadoMatricula = ApoderadoMatricula::where('alumno_id', $data->id)
                                                                            ->where('matricula_id', $matricula->id)
                                                                            ->where('activo', 1)
                                                                            ->where('borrado', 0)
                                                                            ->first();
                                    $matricula->apoderadoMatricula = $apoderadoMatricula;
                                }

            $data->matriculas = $matriculas;

            $data->fullNombre = $data->apellido_paterno . ' ' . $data->apellido_materno . ' ' . $data->nombres;
        }
        

        return $data;
    }
}
