<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

    public static function GetCicloActivo(){
        $registro = CicloEscolar::where('activo','1')
                    ->where('borrado','0')
                    ->first();

        return $registro;
    }
}
