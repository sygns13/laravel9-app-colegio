<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

class Docente extends Model
{
    use HasFactory;

    protected $table = 'docentes';
    protected $fillable = ['id',
                            'tipo_documento_id',
                            'num_documento',
                            'apellidos',
                            'nombre',
                            'especialidad',
                            'genero',
                            'telefono',
                            'direccion',
                            'codigo_plaza',
                            'user_id',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetDocentes(Request $request){

        $buscar=$request->busca;

        $registros = DB::table('docentes')
        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'docentes.tipo_documento_id')
        ->join('users', 'users.id', '=', 'docentes.user_id')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        
        ->where('docentes.borrado','0')

        ->where(function($query) use ($buscar){
            $query->where('docentes.num_documento','like','%'.$buscar.'%');
            $query->orWhere('docentes.nombre','like','%'.$buscar.'%');
            $query->orWhere('docentes.apellidos','like','%'.$buscar.'%');
            $query->orWhere('docentes.especialidad','like','%'.$buscar.'%');
            $query->orWhere('tipo_documentos.nombre','like','%'.$buscar.'%');
            $query->orWhere('users.name','like','%'.$buscar.'%');
            $query->orWhere('users.email','like','%'.$buscar.'%');
            }) 
            ->orderBy('docentes.apellidos')
            ->orderBy('docentes.nombre')
            ->orderBy('docentes.id')
        ->select(
                'docentes.id',
                'docentes.tipo_documento_id',
                'docentes.num_documento',
                'docentes.apellidos',
                'docentes.nombre',
                'docentes.especialidad',
                'docentes.genero',
                'docentes.telefono',
                'docentes.direccion',
                'docentes.codigo_plaza',
                'docentes.user_id',
                'docentes.activo',
                'docentes.borrado',

                'tipo_documentos.id as tipo_documentos_id',
                'tipo_documentos.nombre as tipo_documentos_nombre',
                'tipo_documentos.sigla as tipo_documentos_sigla',
                'tipo_documentos.digitos as tipo_documentos_digitos',

                'tipo_users.id as tipo_users_id',
                'tipo_users.nombre as tipo_users_nombre',
                'tipo_users.descripcion as tipo_users_descripcion',

                'users.id as users_id',
                'users.name as users_name',
                'users.email as users_email',
                'users.activo as users_activo',
         )
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
}
