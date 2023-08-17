<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Auth;
use DB;

class Mensaje extends Model
{
    use HasFactory;

    protected $table = 'mensajes';
    protected $fillable = ['fecha',
                            'hora',
                            'estado',
                            'titulo',
                            'mensaje',
                            'user_id_envia',
                            'activo',
                            'borrado',
                        ];
	protected $guarded = ['id'];

    public static function GetNotificaciones(){
        $iduser = Auth::user()->id;

        $registros = DB::table('user_mensajes')
        ->join('mensajes', 'mensajes.id', '=', 'user_mensajes.mensaje_id')
        ->join('users', 'users.id', '=', 'mensajes.user_id_envia')
        ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')

        ->where('user_mensajes.borrado','0')
        ->where('user_mensajes.estado','0')
        ->where('mensajes.borrado','0')
        ->where('user_mensajes.user_id', $iduser)

        ->orderBy('fecha', 'desc')
        ->orderBy('hora', 'desc')
        ->orderBy('id', 'desc')

        ->select(
            'mensajes.id as id',
            'mensajes.fecha',
            DB::Raw("DATE_FORMAT(`mensajes`.`fecha`,'%d/%m/%Y') as fecha"),
            'mensajes.hora',
            'mensajes.estado',
            'mensajes.titulo',
            'mensajes.mensaje',
            'mensajes.user_id_envia',

            'user_mensajes.id as user_mensajes_id',
            'user_mensajes.user_id as user_mensajes_user_id',
            DB::Raw("IFNULL(DATE_FORMAT(`user_mensajes`.`fecha_leida`,'%d/%m/%Y'),'') as user_mensajes_fecha_leida"),
            'user_mensajes.hora_leida as user_mensajes_hora_leida',
            'user_mensajes.estado as user_mensajes_estado',

            'tipo_users.id as tipo_users_id',
            'tipo_users.nombre as tipo_users_nombre',
            'tipo_users.descripcion as tipo_users_descripcion',

            'users.id as users_id',
            'users.name as users_name',
            'users.email as users_email',
            'users.activo as users_activo',
        )->get();

        foreach ($registros as $key => $dato) {
            if($dato->tipo_users_id == '1'){
                $director = Director::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                $dato->director = $director;
            }
            elseif($dato->tipo_users_id == '3') {
                $docente = Docente::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                $dato->docente = $docente;
            }
            elseif($dato->tipo_users_id == '4') {
                $alumno = Alumno::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                $dato->alumno = $alumno;
            }
            elseif($dato->tipo_users_id == '5') {
                $apoderado = ApoderadoUser::where('borrado', '0')->where('user_id', $dato->users_id)->first();
                $dato->apoderado = $apoderado;
            }
        }

        return $registros;
    }
}
