<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\InstitucionEducativa;
use App\Models\CicloEscolar;
use App\Models\CicloNivel;
use App\Models\CicloGrado;
use App\Models\CicloSeccion;
use App\Models\CicloCurso;
use App\Models\Niveles;

class Horario extends Model
{
    use HasFactory;

    protected $table = 'horarios';
    protected $fillable = ['dia_semana',
                            'hora_ini',
                            'hora_fin',
                            'ciclo_curso_id',
                            'activo',
                            'borrado',
                            'ciclo_escolar_id',
                            'ciclo_seccion_id',
                            'hora_id',
                            'turno_id',
                        ];
	protected $guarded = ['id'];

    public static function GetAllDataHorarioActivo(){

        $cicloActivo = CicloEscolar::GetCicloActivo();

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        if($cicloActivo){
            $niveles = CicloNivel::where('borrado','0')
            ->where('activo','1')
            ->where('institucion_educativa_id', $data->id)
            ->where('ciclo_escolar_id', $cicloActivo->id)
            ->orderBy('nivel_id')
            ->get();

            foreach ($niveles as $key => $value) {
            $grados = CicloGrado::where('borrado','0')
                            ->where('activo','1')
                            ->where('ciclo_niveles_id', $value->id)
                            ->where('ciclo_escolar_id', $cicloActivo->id)
                            ->orderBy('orden')
                            ->get();

            $nivel = Niveles::find($value->nivel_id);

            $value->siglas = $nivel->siglas;

            foreach ($grados as $keyG => $valueG) {
                $seccions = CicloSeccion::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grados_id', $valueG->id)
                                    ->where('ciclo_escolar_id', $cicloActivo->id)
                                    ->orderBy('sigla')
                                    ->orderBy('nombre')
                                    ->get();
                
                foreach ($seccions as $keyS => $valueS) {
                    $horarios = Horario::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_seccion_id', $valueS->id)
                                    ->where('ciclo_escolar_id', $cicloActivo->id)
                                    ->orderBy('dia_semana')
                                    ->orderBy('hora_ini')
                                    ->get();
                    
                    $valueS->horarios = $horarios;
                }

                $cursos = CicloCurso::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_grado_id', $valueG->id)
                                    ->where('ciclo_escolar_id', $cicloActivo->id)
                                    ->orderBy('orden')
                                    ->orderBy('nombre')
                                    ->get();

                $valueG->seccions = $seccions;
                $valueG->cursos = $cursos;
            }

            $value->grados = $grados;
            }

            $data->niveles = $niveles;
        }
        

        return $data;
    }
}
