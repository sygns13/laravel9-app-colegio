<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\CicloNivel;
use App\Models\Turno;

class CicloEscolar extends Model
{
    use HasFactory;

    protected $table = 'ciclo_escolars';
    protected $fillable = ['year',
                            'nombre',
                            'fecha_ini_clases',
                            'fecha_fin_clases',
                            'activo',
                            'activo_matricula',
                            'borrado',
                            'opcion',
                        ];
	protected $guarded = ['id'];

    public static function GetCiclos(Request $request){

        $buscar=$request->busca;

        $registros = CicloEscolar::where('borrado','0')
                    ->where(function($query) use ($buscar){
                        $query->where('year','like','%'.$buscar.'%');
                        $query->orWhere('nombre','like','%'.$buscar.'%');
                        }) 
                    ->orderBy('year','desc')
                    ->orderBy('id','desc')
                    ->paginate(30);

        foreach ($registros as $key => $value) {
            $cicloNivelInicial = CicloNivel::where('ciclo_escolar_id', $value->id)->where('nivel_id','1')->first();
            $cicloNivelPrimaria = CicloNivel::where('ciclo_escolar_id', $value->id)->where('nivel_id','2')->first();
            $cicloNivelSecundaria = CicloNivel::where('ciclo_escolar_id', $value->id)->where('nivel_id','3')->first();

            if($cicloNivelInicial != null){
                $turno = Turno::find($cicloNivelInicial->turno_id);
                $cicloNivelInicial->turno = $turno->nombre;
            }

            if($cicloNivelPrimaria != null){
                $turno = Turno::find($cicloNivelPrimaria->turno_id);
                $cicloNivelPrimaria->turno = $turno->nombre;
            }

            if($cicloNivelSecundaria != null){
                $turno = Turno::find($cicloNivelSecundaria->turno_id);
                $cicloNivelSecundaria->turno = $turno->nombre;
            }

            $value->cicloNivelInicial = $cicloNivelInicial;
            $value->cicloNivelPrimaria = $cicloNivelPrimaria;
            $value->cicloNivelSecundaria = $cicloNivelSecundaria;
        }                        

        return [
            'pagination'=>[
                'total'=> $registros->total(),
                'current_page'=> $registros->currentPage(),
                'per_page'=> $registros->perPage(),
                'last_page'=> $registros->lastPage(),
                'from'=> $registros->firstItem(),
                'to'=> $registros->lastItem(),
            ],
            'registros'=>$registros
        ];
    }

    public static function GetAllCiclos(){

        $registros = CicloEscolar::where('borrado','0')
                    ->orderBy('year','desc')
                    ->orderBy('id','desc')
                    ->get();

        return $registros;
    }


    public static function GetCicloActivo(){
        $registro = CicloEscolar::where('activo','1')
                    ->where('borrado','0')
                    ->first();

        return $registro;
    }

    public static function GetCicloActivoLast(){
        $registro = CicloEscolar::where('borrado','0')
                    ->where('activo','0')
                    ->orderBy('id','desc')
                    ->first();

        return $registro;
    }
}
