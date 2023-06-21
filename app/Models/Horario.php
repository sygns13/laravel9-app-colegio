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

use DB;

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

    public static function GetDataHorarioByCiclo($ciclo_id){

        $cicloActivo = CicloEscolar::find($ciclo_id);

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

    public static function GetDocenteDataHorarioActivo($ciclo_id, $iduser){

        $user = User::find($iduser);

        $docente = Docente::where('borrado','0')
        ->where('user_id',$iduser)
        ->where('activo','1')
        ->first();

        $cicloActivo = CicloEscolar::find($ciclo_id);

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
                $grados = DB::select("select cg.id, cg.orden, cg.nombre, cg.ciclo_niveles_id, ac.docente_id from asignacion_cursos as ac
                inner join ciclo_seccion cs on ac.ciclo_seccion_id=cs.id
                inner join ciclo_grados cg on cs.ciclo_grados_id=cg.id
                where ac.docente_id = ?
                and cg.ciclo_escolar_id = ?
                and cg.ciclo_niveles_id = ?
                group by cg.orden
                order by cg.orden;", [$docente->id, $ciclo_id, $value->id]);

            $nivel = Niveles::find($value->nivel_id);

            $value->siglas = $nivel->siglas;

            foreach ($grados as $keyG => $valueG) {
                $seccions = DB::select("select cs.id, cs.sigla, cs.nombre, cs.ciclo_grados_id, cs.turno_id from asignacion_cursos as ac
                        inner join ciclo_seccion cs on ac.ciclo_seccion_id=cs.id
                        where ac.docente_id = ?
                        and cs.ciclo_escolar_id = ?
                        and cs.ciclo_grados_id = ?
                        group by cs.id
                        order by cs.id;", [$docente->id, $ciclo_id, $valueG->id]);

                
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

                $cursos = DB::select("select cc.id, cc.orden, cc.nombre, cc.ciclo_grado_id, cc.opcion, cc.color from asignacion_cursos as ac
                        inner join ciclo_cursos cc on ac.ciclo_cursos_id=cc.id
                        where ac.docente_id = ?
                        and cc.ciclo_escolar_id = ?
                        and cc.ciclo_grado_id = ?
                        group by cc.id
                        order by cc.id;", [$docente->id, $ciclo_id, $valueG->id]);


                $valueG->seccions = $seccions;
                $valueG->cursos = $cursos;
            }

            $value->grados = $grados;
            }

            $data->niveles = $niveles;
        }
        

        return $data;
    }

    public static function GetHorarioBySeccion($ciclo_seccion_id){

        $ciclo_seccion = CicloSeccion::findOrFail($ciclo_seccion_id);

        $ciclo = CicloEscolar::find($ciclo_seccion->ciclo_escolar_id);
        $ciclo_grado = CicloGrado::find($ciclo_seccion->ciclo_grados_id);
        $ciclo_nivel = CicloNivel::find($ciclo_grado->ciclo_niveles_id);

        $ciclo_seccion->ciclo = $ciclo;
        $ciclo_seccion->ciclo_grado = $ciclo_grado;
        $ciclo_seccion->ciclo_nivel = $ciclo_nivel;

        $horarios = Horario::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('ciclo_seccion_id', $ciclo_seccion_id)
                                    ->where('ciclo_escolar_id', $ciclo->id)
                                    ->orderBy('dia_semana')
                                    ->orderBy('hora_ini')
                                    ->get();

        foreach ($horarios as $key => $horario) {
            $curso = CicloCurso::find($horario->ciclo_curso_id);
            $horario->curso = $curso;
        }

        $ciclo_seccion->horarios = $horarios;

        return $ciclo_seccion;
    }
}
