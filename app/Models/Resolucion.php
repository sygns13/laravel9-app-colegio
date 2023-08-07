<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Resolucion extends Model
{
    use HasFactory;

    protected $table = 'resolucions';
    protected $fillable = ['tipo',
                            'nombre',
                            'year',
                            'archivo',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetCrudData1(Request $request){

        $registros = Resolucion::where('borrado','0')
        ->where('tipo','1')
        ->orderBy('id', 'desc')
        ->paginate(10);

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

    public static function GetCrudData2(Request $request){

        $registros = Resolucion::where('borrado','0')
        ->where('tipo','2')
        ->orderBy('id', 'desc')
        ->paginate(10);

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
}
