<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;

use App\Models\DocenteAsistenciaDia;
use App\Models\AsistenciaDocente;

class AsistenciaDocente extends Model
{
    use HasFactory;

    protected $table = 'asistencia_docentes';
    protected $fillable = ['fecha',
                            'ciclo_escolar_id',
                            'estado',
                            'observacion',
                            'activo',
                            'borrado',
                            'docente_id',
                            'docentes_asistencias_dia_id',
                        ];
	protected $guarded = ['id'];

    public static function GetDocenteAsistenciaDiaActive($docentes_asistencias_dia_id){

        $asistenciasDocentes = DB::table('docentes')
                    ->join('tipo_documentos', 'tipo_documentos.id', '=', 'docentes.tipo_documento_id')
                    ->join('users', 'users.id', '=', 'docentes.user_id')
                    ->join('tipo_users', 'tipo_users.id', '=', 'users.tipo_user_id')
                    ->leftjoin('asistencia_docentes as asistencia',  function($join) use ($docentes_asistencias_dia_id){
                        $join->on('docentes.id', '=', 'asistencia.docente_id');
                        $join->on('asistencia.docentes_asistencias_dia_id', '=',DB::raw($docentes_asistencias_dia_id));
                        $join->on('asistencia.activo', '=', DB::raw('1'));
                        $join->on('asistencia.borrado', '=', DB::raw('0'));

                    })
                    ->where('docentes.activo','1')
                    ->where('docentes.borrado','0')
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

                        DB::Raw("IFNULL( `asistencia`.`id` , 0 ) as id_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`fecha` , '' ) as fecha_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`ciclo_escolar_id` , '' ) as ciclo_escolar_id_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`estado` , '0' ) as estado_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`observacion` , '' ) as observacion_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`activo` , '' ) as activo_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`borrado` , '' ) as borrado_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`docente_id` , '' ) as docente_id_asistencia"),
                        DB::Raw("IFNULL( `asistencia`.`docentes_asistencias_dia_id` , '' ) as docentes_asistencias_dia_id_asistencia")
                        )
                    ->paginate(30);

        return $asistenciasDocentes;
    }
}
