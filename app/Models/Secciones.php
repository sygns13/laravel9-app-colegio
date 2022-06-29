<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\InstitucionEducativa;
use App\Models\Niveles;
use App\Models\Grado;

class Secciones extends Model
{
    use HasFactory;

    protected $table = 'secciones';
    protected $fillable = ['nombre',
                            'sigla',
                            'grado_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetAllDataIE(){

        $data = InstitucionEducativa::where('borrado','0')
                                    ->where('activo','1')
                                    ->first();
        
        $niveles = Niveles::where('borrado','0')
                        ->where('activo','1')
                        ->where('institucion_educativa_id', $data->id)
                        ->get();

        foreach ($niveles as $key => $value) {
            $grados = Grado::where('borrado','0')
                            ->where('activo','1')
                            ->where('nivele_id', $value->id)
                            ->get();

            foreach ($grados as $keyG => $valueG) {
                $seccions = Secciones::where('borrado','0')
                                    ->where('activo','1')
                                    ->where('grado_id', $valueG->id)
                                    ->get();

                $valueG->seccions = $seccions;
            }

            $value->grados = $grados;
        }

        $data->niveles = $niveles;

        return $data;
    }
}
