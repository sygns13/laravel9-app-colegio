<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    use HasFactory;

    protected $table = 'cursos';
    protected $fillable = ['nombre',
                            'orden',
                            'grado_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetAllDataCursos(){

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        $niveles = Niveles::where('borrado','0')
                        ->where('activo','1')
                        ->where('institucion_educativa_id', $data->id)
                        ->orderBy('id')
                        ->get();

        foreach ($niveles as $key => $value) {
            $grados = Grado::where('borrado','0')
                            ->where('activo','1')
                            ->where('nivele_id', $value->id)
                            ->orderBy('orden')
                            ->get();

            foreach ($grados as $keyG => $valueG) {
                $cursos = Curso::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('grado_id', $valueG->id)
                                    ->orderBy('orden')
                                    ->orderBy('nombre')
                                    ->get();

                foreach ($cursos as $keyC => $valueC) {
                    $competencias = Competencia::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('cursos_id', $valueC->id)
                                    ->orderBy('orden')
                                    ->orderBy('nombre')
                                    ->get();

                    $valueC->competencias = $competencias;
                }

                $valueG->cursos = $cursos;
            }

            $value->grados = $grados;
        }

        $data->niveles = $niveles;

        return $data;
    }

    public static function GetCursosByGrado($grado_id){

        $cursos = Curso::where('borrado','0')
                        ->where('activo','1')
                        ->where('grado_id', $grado_id)
                        ->orderBy('orden')
                        ->orderBy('nombre')
                        ->get();

        foreach ($cursos as $keyC => $valueC) {
            $competencias = Competencia::where('borrado','0')
                            ->where('activo','1')
                            ->where('cursos_id', $valueC->id)
                            ->orderBy('orden')
                            ->orderBy('nombre')
                            ->get();

            $valueC->competencias = $competencias;
        }

        return $cursos;

    }
}
