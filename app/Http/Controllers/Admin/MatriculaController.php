<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

use App\Models\CicloEscolar;
use App\Models\Matricula;
use App\Models\TipoDocumento;
use App\Models\User;
use App\Models\Estado;
use App\Models\Departamento;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\Niveles;
use App\Models\Grado;
use App\Models\CicloSeccion;
use App\Models\Alumno;
use App\Models\Apoderado;
use App\Models\Traslado;
use App\Models\Domicilio;
use App\Models\ApoderadoMatricula;
use App\Models\Turno;
use App\Models\Nota;

use App\Models\CicloNivel;
use App\Models\CicloGrado;

use App\Models\InstitucionEducativa;
use App\Models\ApoderadoUser;
use App\Models\Docente;
use App\Models\Mensaje;

use stdClass;
use DB;
use Storage;
use PDF;

use Illuminate\Support\Facades\Hash;

class MatriculaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index1()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();

        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();

        $niveles = Niveles::where('activo',1)->where('borrado',0)->orderBy('id','asc')->get();
        $grados = Grado::where('activo',1)->where('borrado',0)->orderBy('orden','asc')->get();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.matricula.index',compact('cicloActivo', 'estados', 'departamentos', 'provincias', 'distritos', 'niveles', 'grados', 'mensajes'));
    }

    public function index2()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.nomina.index',compact('cicloActivo', 'ciclos', 'mensajes'));
    }

    public function index3()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.docnominas.index',compact('cicloActivo', 'ciclos', 'mensajes'));
    }
    public function index4()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $cicloActivoLast = CicloEscolar::GetCicloActivoLast();

        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $mensajes = Mensaje::GetNotificaciones();

        $niveles = []; 
        $grados = []; 
        $secciones = []; 

        if(!$cicloActivoLast){
            return view('admin.matricula-masiva.index',compact('cicloActivo','cicloActivoLast', 'estados', 'departamentos', 'provincias', 'distritos', 'niveles', 'grados','secciones', 'mensajes'));
        }
        
        $niveles = CicloNivel::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivoLast->id)->orderBy('id','asc')->get();
        $grados = CicloGrado::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivoLast->id)->orderBy('id','asc')->get();
        $secciones = CicloSeccion::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivoLast->id)->orderBy('id','asc')->get();

        $nivelesNow = CicloNivel::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $gradosNow = CicloGrado::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $seccionesNow = CicloSeccion::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();

        return view('admin.matricula-masiva.index',compact('cicloActivo','cicloActivoLast', 'estados', 'departamentos', 'provincias', 'distritos', 'niveles', 'grados','secciones', 'nivelesNow', 'gradosNow', 'seccionesNow', 'mensajes'));
    }

    public function index5()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();

        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();

        $niveles = CicloNivel::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $grados = CicloGrado::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $secciones = CicloSeccion::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.verificar-matricula.index',compact('mensajes','ciclos','cicloActivo', 'estados', 'departamentos', 'provincias', 'distritos', 'niveles', 'grados','secciones'));
    }

    public function index6()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $ciclos = CicloEscolar::GetAllCiclos();

        $estados = Estado::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $departamentos = Departamento::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $provincias = Provincia::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();
        $distritos = Distrito::where('activo',1)->where('borrado',0)->orderBy('nombre','asc')->get();

        $niveles = CicloNivel::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $grados = CicloGrado::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $secciones = CicloSeccion::where('activo',1)->where('borrado',0)->where('ciclo_escolar_id',$cicloActivo->id)->orderBy('id','asc')->get();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.consultar-matricula.index',compact('mensajes','ciclos','cicloActivo', 'estados', 'departamentos', 'provincias', 'distritos', 'niveles', 'grados','secciones'));
    }

    public function indexGetVerificar(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $buscar=$request->busca;
        $ciclo_id=$request->ciclo_id;

        $result='1';
        $msj='';
        $selector='';

        $iduser=Auth::user()->id;
        $user = User::find($iduser);

        $apoderadoUsers = ApoderadoUser::where('activo','1')->where('borrado','0')
                                        ->where('user_id',$iduser)
                                        ->get();

        $alumnosIds = array();

        foreach ($apoderadoUsers as $key => $dato) {
            $tipoDocumento = TipoDocumento::find($dato->tipo_documento_id);
            $dato->tipoDocumento = $tipoDocumento;

            $alumnosIds[] = $dato->alumno_id;
        }

        $registros = DB::table('matriculas')
                        ->join('alumnos', 'alumnos.id', '=', 'matriculas.alumno_id')
                        ->join('ciclo_seccion', 'ciclo_seccion.id', '=', 'matriculas.ciclo_seccion_id')
                        ->join('ciclo_grados', 'ciclo_grados.id', '=', 'ciclo_seccion.ciclo_grados_id')
                        ->join('ciclo_niveles', 'ciclo_niveles.id', '=', 'ciclo_grados.ciclo_niveles_id')
                        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'alumnos.tipo_documento_id')
    
                        ->where('matriculas.activo','1')
                        ->where('matriculas.borrado', '0')
                        ->where('matriculas.ciclo_escolar_id', $ciclo_id)
                        ->where(function($query) use ($buscar){
                            $query->where('alumnos.num_documento','like','%'.$buscar.'%');
                            $query->orWhere('alumnos.nombres','like','%'.$buscar.'%');
                            $query->orWhere('alumnos.apellido_paterno','like','%'.$buscar.'%');
                            $query->orWhere('alumnos.apellido_materno','like','%'.$buscar.'%');
                            }) 
                        ->whereIn('alumnos.id', $alumnosIds)
                            ->orderBy('ciclo_niveles.id')
                            ->orderBy('ciclo_grados.id')
                            ->orderBy('ciclo_seccion.id')
                            ->orderBy('alumnos.apellido_paterno')
                            ->orderBy('alumnos.apellido_materno')
                            ->orderBy('alumnos.nombres')
                            ->orderBy('matriculas.id')
                            ->select('matriculas.id',
                                'matriculas.alumno_id',
                                'matriculas.ciclo_escolar_id',
                                'matriculas.fecha',
                                'matriculas.estado',
                                'matriculas.es_traslado',
                                'matriculas.tiene_discapacidad',
                                'matriculas.vive_madre',
                                'matriculas.vive_padre',
                                'matriculas.responsable_matricula_nombres',
                                'matriculas.cargo_responsable',
                                'matriculas.ciclo_seccion_id',
                                'matriculas.situacion_final',
                                'matriculas.nota_final',
                                'matriculas.situacion',
                                'matriculas.sigla_situacion',
                                'matriculas.trabaja',
                                'matriculas.activo',
                                'matriculas.borrado',
                                'matriculas.created_at',
                                'matriculas.updated_at',
                                'matriculas.DI',
                                'matriculas.DA',
                                'matriculas.DV',
                                'matriculas.DM',
                                'matriculas.SC',
                                'matriculas.OT',
                                'matriculas.sigla_situacion_final',
                                'matriculas.validado_apoderado',
                                'matriculas.validado_director',
                                'matriculas.fecha_valid_apo',
                                'matriculas.fecha_valid_dir',
                                'alumnos.id as id_alu',
                                'alumnos.tipo_documento_id as tipo_documento_id_alu',
                                'alumnos.num_documento as num_documento_alu',
                                'alumnos.apellido_paterno as apellido_paterno_alu',
                                'alumnos.apellido_materno as apellido_materno_alu',
                                'alumnos.nombres as nombres_alu',
                                'alumnos.fecha_nacimiento as fecha_nacimiento_alu',
                                'alumnos.genero as genero_alu',
                                'alumnos.grado_actual as grado_actual_alu',
                                'alumnos.nivel_actual as nivel_actual_alu',
                                'alumnos.telefono as telefono_alu',
                                'alumnos.direccion as direccion_alu',
                                'alumnos.correo as correo_alu',
                                'alumnos.pais as pais_alu',
                                'alumnos.sigla_pais as sigla_pais_alu',
                                'alumnos.departamento as departamento_alu',
                                'alumnos.provincia as provincia_alu',
                                'alumnos.distrito as distrito_alu',
                                'alumnos.lugar as lugar_alu',
                                'alumnos.lengua_materna as lengua_materna_alu',
                                'alumnos.segunda_lengua as segunda_lengua_alu',
                                'alumnos.num_hermanos as num_hermanos_alu',
                                'alumnos.lugar_hermano as lugar_hermano_alu',
                                'alumnos.religion as religion_alu',
                                'alumnos.DI as DI_alu',
                                'alumnos.DA as DA_alu',
                                'alumnos.DV as DV_alu',
                                'alumnos.nacimiento as nacimiento_alu',
                                'alumnos.obs_nacimiento as obs_nacimiento_alu',
                                'alumnos.levanto_cabeza as levanto_cabeza_alu',
                                'alumnos.se_sento as se_sento_alu',
                                'alumnos.se_paro as se_paro_alu',
                                'alumnos.se_camino as se_camino_alu',
                                'alumnos.se_control_esfinter as se_control_esfinter_alu',
                                'alumnos.se_primeras_palabras as se_primeras_palabras_alu',
                                'alumnos.se_hablo_fluido as se_hablo_fluido_alu',
                                'alumnos.nacimiento_registrado as nacimiento_registrado_alu',
                                'alumnos.activo as activo_alu',
                                'alumnos.borrado as borrado_alu',
                                'alumnos.created_at as created_at_alu',
                                'alumnos.updated_at as updated_at_alu',
                                'alumnos.estado_grado as estado_grado_alu',
                                'alumnos.DM as DM_alu',
                                'alumnos.SC as SC_alu',
                                'alumnos.OT as OT_alu',
                                'alumnos.user_id as user_id_alu',
                                'alumnos.pais_id as pais_id_alu',
                                'alumnos.departamento_id as departamento_id_alu',
                                'alumnos.provincia_id as provincia_id_alu',
                                'alumnos.distrito_id as distrito_id_alu',
                                'alumnos.anio_ingreso as anio_ingreso_alu',
                                'alumnos.codigo_modular as codigo_modular_alu',
                                'alumnos.numero_matricula as numero_matricula_alu',
                                'alumnos.flag as flag_alu',
                                'alumnos.old_estado_grado as old_estado_grado_alu',
                                'alumnos.celular as celular_alu',

                                'tipo_documentos.id as id_tipodoc',
                                'tipo_documentos.nombre as nombre_tipodoc',
                                'tipo_documentos.sigla as sigla_tipodoc',
                                'tipo_documentos.digitos as digitos_tipodoc',

                                'ciclo_niveles.id as id_ciclo_niveles',
                                'ciclo_niveles.nombre as nombre_ciclo_niveles',

                                'ciclo_grados.id as id_ciclo_grados',
                                'ciclo_grados.nombre as nombre_ciclo_grados',

                                'ciclo_seccion.id as id_ciclo_seccion',
                                'ciclo_seccion.nombre as nombre_ciclo_seccion',
                                'ciclo_seccion.sigla as sigla_ciclo_seccion',

                                )
                                ->paginate(30);

            foreach ($registros as $key => $matricula) {
                $matricula->numero_matricula_alu = str_pad($matricula->numero_matricula_alu, 4, "0", STR_PAD_LEFT);
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

    public function indexGetDirector(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $buscar=$request->busca;
        $ciclo_id=$request->ciclo_id;

        $result='1';
        $msj='';
        $selector='';

        $iduser=Auth::user()->id;
        $user = User::find($iduser);


        $registros = DB::table('matriculas')
                        ->join('alumnos', 'alumnos.id', '=', 'matriculas.alumno_id')
                        ->join('ciclo_seccion', 'ciclo_seccion.id', '=', 'matriculas.ciclo_seccion_id')
                        ->join('ciclo_grados', 'ciclo_grados.id', '=', 'ciclo_seccion.ciclo_grados_id')
                        ->join('ciclo_niveles', 'ciclo_niveles.id', '=', 'ciclo_grados.ciclo_niveles_id')
                        ->join('tipo_documentos', 'tipo_documentos.id', '=', 'alumnos.tipo_documento_id')
    
                        ->where('matriculas.activo','1')
                        ->where('matriculas.borrado', '0')
                        ->where('matriculas.ciclo_escolar_id', $ciclo_id)
                        ->where(function($query) use ($buscar){
                            $query->where('alumnos.num_documento','like','%'.$buscar.'%');
                            $query->orWhere('alumnos.nombres','like','%'.$buscar.'%');
                            $query->orWhere('alumnos.apellido_paterno','like','%'.$buscar.'%');
                            $query->orWhere('alumnos.apellido_materno','like','%'.$buscar.'%');
                            }) 
                            ->orderBy('ciclo_niveles.id')
                            ->orderBy('ciclo_grados.id')
                            ->orderBy('ciclo_seccion.id')
                            ->orderBy('alumnos.apellido_paterno')
                            ->orderBy('alumnos.apellido_materno')
                            ->orderBy('alumnos.nombres')
                            ->orderBy('matriculas.id')
                            ->select('matriculas.id',
                                'matriculas.alumno_id',
                                'matriculas.ciclo_escolar_id',
                                'matriculas.fecha',
                                'matriculas.estado',
                                'matriculas.es_traslado',
                                'matriculas.tiene_discapacidad',
                                'matriculas.vive_madre',
                                'matriculas.vive_padre',
                                'matriculas.responsable_matricula_nombres',
                                'matriculas.cargo_responsable',
                                'matriculas.ciclo_seccion_id',
                                'matriculas.situacion_final',
                                'matriculas.nota_final',
                                'matriculas.situacion',
                                'matriculas.sigla_situacion',
                                'matriculas.trabaja',
                                'matriculas.activo',
                                'matriculas.borrado',
                                'matriculas.created_at',
                                'matriculas.updated_at',
                                'matriculas.DI',
                                'matriculas.DA',
                                'matriculas.DV',
                                'matriculas.DM',
                                'matriculas.SC',
                                'matriculas.OT',
                                'matriculas.sigla_situacion_final',
                                'matriculas.validado_apoderado',
                                'matriculas.validado_director',
                                'matriculas.fecha_valid_apo',
                                'matriculas.fecha_valid_dir',
                                'alumnos.id as id_alu',
                                'alumnos.tipo_documento_id as tipo_documento_id_alu',
                                'alumnos.num_documento as num_documento_alu',
                                'alumnos.apellido_paterno as apellido_paterno_alu',
                                'alumnos.apellido_materno as apellido_materno_alu',
                                'alumnos.nombres as nombres_alu',
                                'alumnos.fecha_nacimiento as fecha_nacimiento_alu',
                                'alumnos.genero as genero_alu',
                                'alumnos.grado_actual as grado_actual_alu',
                                'alumnos.nivel_actual as nivel_actual_alu',
                                'alumnos.telefono as telefono_alu',
                                'alumnos.direccion as direccion_alu',
                                'alumnos.correo as correo_alu',
                                'alumnos.pais as pais_alu',
                                'alumnos.sigla_pais as sigla_pais_alu',
                                'alumnos.departamento as departamento_alu',
                                'alumnos.provincia as provincia_alu',
                                'alumnos.distrito as distrito_alu',
                                'alumnos.lugar as lugar_alu',
                                'alumnos.lengua_materna as lengua_materna_alu',
                                'alumnos.segunda_lengua as segunda_lengua_alu',
                                'alumnos.num_hermanos as num_hermanos_alu',
                                'alumnos.lugar_hermano as lugar_hermano_alu',
                                'alumnos.religion as religion_alu',
                                'alumnos.DI as DI_alu',
                                'alumnos.DA as DA_alu',
                                'alumnos.DV as DV_alu',
                                'alumnos.nacimiento as nacimiento_alu',
                                'alumnos.obs_nacimiento as obs_nacimiento_alu',
                                'alumnos.levanto_cabeza as levanto_cabeza_alu',
                                'alumnos.se_sento as se_sento_alu',
                                'alumnos.se_paro as se_paro_alu',
                                'alumnos.se_camino as se_camino_alu',
                                'alumnos.se_control_esfinter as se_control_esfinter_alu',
                                'alumnos.se_primeras_palabras as se_primeras_palabras_alu',
                                'alumnos.se_hablo_fluido as se_hablo_fluido_alu',
                                'alumnos.nacimiento_registrado as nacimiento_registrado_alu',
                                'alumnos.activo as activo_alu',
                                'alumnos.borrado as borrado_alu',
                                'alumnos.created_at as created_at_alu',
                                'alumnos.updated_at as updated_at_alu',
                                'alumnos.estado_grado as estado_grado_alu',
                                'alumnos.DM as DM_alu',
                                'alumnos.SC as SC_alu',
                                'alumnos.OT as OT_alu',
                                'alumnos.user_id as user_id_alu',
                                'alumnos.pais_id as pais_id_alu',
                                'alumnos.departamento_id as departamento_id_alu',
                                'alumnos.provincia_id as provincia_id_alu',
                                'alumnos.distrito_id as distrito_id_alu',
                                'alumnos.anio_ingreso as anio_ingreso_alu',
                                'alumnos.codigo_modular as codigo_modular_alu',
                                'alumnos.numero_matricula as numero_matricula_alu',
                                'alumnos.flag as flag_alu',
                                'alumnos.old_estado_grado as old_estado_grado_alu',
                                'alumnos.celular as celular_alu',

                                'tipo_documentos.id as id_tipodoc',
                                'tipo_documentos.nombre as nombre_tipodoc',
                                'tipo_documentos.sigla as sigla_tipodoc',
                                'tipo_documentos.digitos as digitos_tipodoc',

                                'ciclo_niveles.id as id_ciclo_niveles',
                                'ciclo_niveles.nombre as nombre_ciclo_niveles',

                                'ciclo_grados.id as id_ciclo_grados',
                                'ciclo_grados.nombre as nombre_ciclo_grados',

                                'ciclo_seccion.id as id_ciclo_seccion',
                                'ciclo_seccion.nombre as nombre_ciclo_seccion',
                                'ciclo_seccion.sigla as sigla_ciclo_seccion',

                                )
                                ->paginate(30);


        foreach ($registros as $key => $matricula) {
            $matricula->numero_matricula_alu = str_pad($matricula->numero_matricula_alu, 4, "0", STR_PAD_LEFT);
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

    public function index(Request $request)
    {
        return $tipoDocumentos = TipoDocumento::all();
    }

    public function indexNomina(Request $request)
    {
        $ciclo_id = $request->ciclo_id;

        $registros = Matricula::GetDatosGenericsByCiclo($ciclo_id);

        return [ 
                'registros' => $registros,
               ];
    }

    public function indexDocNomina(Request $request)
    {
        $ciclo_id = $request->ciclo_id;
        $iduser =Auth::user()->id;

        $registros = Matricula::GetDatosGenericsByCicloDocente($ciclo_id, $iduser);

        return [ 
                'registros' => $registros,
               ];
    }

    public function indexAsignacionTutor()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $docentesActivos = Docente::where('activo', '1')->where('borrado', '0')->orderBy('apellidos')->orderBy('nombre')->get();
        $mensajes = Mensaje::GetNotificaciones();

        return view('admin.asignacion-tutor.index',compact('cicloActivo', 'docentesActivos', 'mensajes'));
    }

    public function indexGetTutor()
    {
        $registros = Matricula::GetAllDataAsignacionActivo();

        return [ 
            'registros' => $registros
           ];
    }

    public function indexApreciacionTutor()
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();
        $hoy = date('Y-m-d');
        $mensajes = Mensaje::GetNotificaciones();

        return view('docente.apreciacion-tutor.index',compact('cicloActivo', 'hoy', 'mensajes'));
    }

    public function indexGetTutorAsignación()
    {

        $cicloActivo = CicloEscolar::GetCicloActivo();
        $iduser =Auth::user()->id;

        $registros = Matricula::GetAllDataTutorActivo($cicloActivo->id, $iduser);

        return [ 
            'registros' => $registros
           ];
    }

    public function getCicloSeccion($gradoMaster_id)
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();

        if(!$cicloActivo){
            return [];
        }
        
        $cicloSeccions = CicloSeccion::GetSeccionsByCicloAndGradoMaster($cicloActivo->id, $gradoMaster_id);

        return $cicloSeccions;
    }

    public function getMatriculaActiva($alumno_id)
    {
        $cicloActivo = CicloEscolar::GetCicloActivo();

        if(!$cicloActivo){

            return response()->json(["result"=>'0','msj'=>"No existe ciclo activo",'matricula'=>null]);
            return null;
        }
        
        $matricula = Matricula::GetMatriculasByCicloAndAlumno($cicloActivo->id, $alumno_id);

        if($matricula == null){
            return response()->json(["result"=>'0','msj'=>"Matricula no encontrada",'matricula'=>null, 'traslado'=>null]);
        }

        $traslado = Traslado::where('matricula_id',$matricula->id)
                                ->where('tipo', '1')
                                ->where('activo', '1')
                                ->where('borrado', '0')
                                ->first();

        $cicloSeccion = CicloSeccion::find($matricula->ciclo_seccion_id);

        $turno = Turno::find($cicloSeccion->turno_id);
        $turno = $turno->nombre;

        return response()->json(["result"=>'1','msj'=>"",'matricula'=>$matricula, 'traslado'=>$traslado, 'turno' => $turno]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $alumno_id = $request->alumno_id;
        $matricula = json_decode(stripslashes($request->matricula));
        $traslado = json_decode(stripslashes($request->traslado));


        //Binding Data

        $cicloActivo = CicloEscolar::GetCicloActivo();

        if(!$cicloActivo){
            $result='0';
            $msj='No se cuenta con un Año Escolar Lectivo Activo, contacte con el administrador del sistema';
            $selector='cbuciclo_escolar_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $alumno = Alumno::find($alumno_id);

        if(!$alumno){
            $result='0';
            $msj='Seleccione un alumno';
            $selector='txtalumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $estado = 1;
        $matri_es_traslado = isset($matricula->es_traslado) ? $matricula->es_traslado : null;
        $matri_responsable_matricula_nombres = isset($matricula->responsable_matricula_nombres) ? $matricula->responsable_matricula_nombres : null;
        $matri_cargo_responsable = isset($matricula->cargo_responsable) ? $matricula->cargo_responsable : null;
        $matri_ciclo_seccion_id = isset($matricula->ciclo_seccion_id) ? $matricula->ciclo_seccion_id : null;
        $matri_trabaja = isset($matricula->trabaja) ? $matricula->trabaja : null;
        $matri_activo = isset($matricula->activo) ? $matricula->activo : null;
        
        $traslado_motivo = isset($traslado->motivo) ? $traslado->motivo : null;
        $traslado_codigo_modular = isset($traslado->codigo_modular) ? $traslado->codigo_modular : null;
        $traslado_ie_nombre = isset($traslado->ie_nombre) ? $traslado->ie_nombre : null;
        $traslado_res_traslado = isset($traslado->res_traslado) ? $traslado->res_traslado : null;


        $input1  = array('matri_es_traslado' => $matri_es_traslado);
        $reglas1 = array('matri_es_traslado' => 'required');

        $input2  = array('matri_responsable_matricula_nombres' => $matri_responsable_matricula_nombres);
        $reglas2 = array('matri_responsable_matricula_nombres' => 'required');

        $input3  = array('matri_cargo_responsable' => $matri_cargo_responsable);
        $reglas3 = array('matri_cargo_responsable' => 'required');

        $input4  = array('matri_ciclo_seccion_id' => $matri_ciclo_seccion_id);
        $reglas4 = array('matri_ciclo_seccion_id' => 'required');

        $input5  = array('matri_trabaja' => $matri_trabaja);
        $reglas5 = array('matri_trabaja' => 'required');

        $input6  = array('matri_activo' => $matri_activo);
        $reglas6 = array('matri_activo' => 'required');

        $input7  = array('traslado_motivo' => $traslado_motivo);
        $reglas7 = array('traslado_motivo' => 'required');

        $input8  = array('traslado_codigo_modular' => $traslado_codigo_modular);
        $reglas8 = array('traslado_codigo_modular' => 'required');

        $input9  = array('traslado_ie_nombre' => $traslado_ie_nombre);
        $reglas9 = array('traslado_ie_nombre' => 'required');

        $input10  = array('traslado_res_traslado' => $traslado_res_traslado);
        $reglas10 = array('traslado_res_traslado' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);
        $validator9 = Validator::make($input9, $reglas9);
        $validator10 = Validator::make($input10, $reglas10);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe de seleccionar si el alumno es traslado';
            $selector='cbumatri_es_traslado';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el responsable de la matricula';
            $selector='txtmatri_responsable_matricula_nombres';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar el cargo del responsable de la matricula';
            $selector='txtmatri_cargo_responsable';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails() || intval($matri_ciclo_seccion_id) == 0)
        {
            $result='0';
            $msj='Debe de seleccionar la seccion del alumno';
            $selector='cbumatri_ciclo_seccion_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        

        if (($validator8->fails() || strlen(strval($traslado_codigo_modular)) != 7) && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el código modular de la IE de procedencia del alumno, debe de tener 7 dígitos';
            $selector='txttraslado_codigo_modular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator9->fails() && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el nombre de la IE de procedencia del alumno';
            $selector='txttraslado_ie_nombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator10->fails() && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el nombre de la Resolución de traslado';
            $selector='txttraslado_res_traslado';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator7->fails() && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el motivo del traslado';
            $selector='txttraslado_motivo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $archivo="";
        $file = $request->archivo;
        $segureFile=0;

        if(intval($matri_es_traslado) == 1){
            if($request->hasFile('archivo')){

                $nombreArchivo=$request->nombrefile;

                $aux2='documento_'.date('d-m-Y').'-'.date('H-i-s');
                $input2  = array('archivo' => $file) ;
                $reglas2 = array('archivo' => 'required|file:1,1024000');
                $validatorF = Validator::make($input2, $reglas2);     

                if ($validatorF->fails())
                {
                    $segureFile=1;
                    $msj="El archivo adjunto ingresado tiene un tamaño superior a 100 MB, ingrese otro archivo o limpie el formulario";
                    $result='0';
                    $selector='archivo';
                }
                else
                {
                    $nombre2=$file->getClientOriginalName();
                    $extension2=$file->getClientOriginalExtension();
                    $nuevoNombre2=$aux2.".".$extension2;
                    //$subir2=Storage::disk('infoFile')->put($nuevoNombre2, \File::get($file));

                    if($extension2=="pdf"|| $extension2=="PDF")
                    {

                        $subir2=false;
                        $subir2=Storage::disk('documentoMatricula')->put($nuevoNombre2, \File::get($file));

                    if($subir2){
                        $archivo=$nuevoNombre2;
                    }
                    else{
                        $msj="Error al subir el archivo adjunto, intentelo nuevamente luego";
                        $segureFile=1;
                        $result='0';
                        $selector='archivo';
                    }
                    }
                    else {
                        $segureFile=1;
                        $msj="El archivo adjunto ingresado tiene una extensión no válida, ingrese otro archivo o limpie el formulario";
                        $result='0';
                        $selector='archivo';
                    }
                }

            }
            else{
                $msj="Debe de adjuntar un archivo adjunto válido, ingrese un archivo";
                $segureFile=1;
                $result='0';
                $selector='archivo';
            }     
        }   

        if($segureFile==1){
            Storage::disk('documentoMatricula')->delete($archivo);
        }
        else{

            $vive_madre = 0;
            $vive_padre = 0;

            $apoderados = Apoderado::where('alumno_id',$alumno_id)
                            ->where('activo',1)
                            ->where('borrado',0)
                            ->get();

            foreach ($apoderados as $apoderado) {
                if($apoderado->tipo_apoderado_id == 1){
                    $vive_madre = $apoderado->vive;
                }
                if($apoderado->tipo_apoderado_id == 2){
                    $vive_padre = $apoderado->vive;
                }
            }

            $tiene_discapacidad = 0;

            if(intval($alumno->DI) == 1 ||
                intval($alumno->DA) == 1 ||
                intval($alumno->DV) == 1 ||
                intval($alumno->DM) == 1 ||
                intval($alumno->SC) == 1 ||
                intval($alumno->OT) == 1 )
                {
                    $tiene_discapacidad = 1;
                }

            $fecha = date("Y-m-d");

            $alumnoSave = Alumno::find($alumno->id);
            $alumnoSave->estado_grado = '1';

            if(0 == intval($alumno->estado_grado) && null == $alumno->anio_ingreso){
                $contMatriculas = Matricula::where('alumno_id', $alumno->id)->count();

                if($contMatriculas == 0){

                    $ie = InstitucionEducativa::where('borrado','0')
                                            ->where('activo','1')
                                            ->first();

                    $alumnoSave->anio_ingreso = $cicloActivo->year;
                    $alumnoSave->codigo_modular = $ie->codigo_modular;

                    $numMatricula = 1;
                    $flag = 0;

                    $countAlumnosYear = Alumno::where('anio_ingreso', $cicloActivo->year)->count();

                    while ($countAlumnosYear >= 10000) {
                        $countAlumnosYear -=10000; 
                        $flag++;
                    }
                    $numMatricula += $countAlumnosYear;

                    $alumnoSave->numero_matricula = $numMatricula;
                    $alumnoSave->flag = $flag;
                }
            }

            $alumnoSave->save();

            $registro = new Matricula;

            $registro->alumno_id = $alumno->id;
            $registro->ciclo_escolar_id = $cicloActivo->id;
            $registro->fecha = $fecha;
            $registro->estado = $estado;
            $registro->es_traslado = $matri_es_traslado;
            $registro->tiene_discapacidad = $tiene_discapacidad;
            $registro->vive_madre = $vive_madre;
            $registro->vive_padre = $vive_padre;
            $registro->responsable_matricula_nombres = strtoupper($matri_responsable_matricula_nombres);
            $registro->cargo_responsable = strtoupper($matri_cargo_responsable);
            $registro->ciclo_seccion_id = $matri_ciclo_seccion_id;
            $registro->trabaja = $matri_trabaja;
            $registro->activo='1';
            $registro->borrado='0';
            $registro->DI = $alumno->DI;
            $registro->DA = $alumno->DA;
            $registro->DV = $alumno->DV;
            $registro->DM = $alumno->DM;
            $registro->SC = $alumno->SC;
            $registro->OT = $alumno->OT;
            $registro->validado_apoderado='1';
            $registro->validado_director='1';
            $registro->fecha_valid_apo = $fecha;
            $registro->fecha_valid_dir = $fecha;

            $registro->save();

            if(intval($matri_es_traslado) == 1){

                $registroB = new Traslado;

                $registroB->fecha = $fecha;
                $registroB->motivo = $traslado_motivo;
                $registroB->codigo_modular = $traslado_codigo_modular;
                $registroB->ie_nombre = strtoupper($traslado_ie_nombre);
                $registroB->alumno_id = $alumno->id;
                $registroB->activo ='1';
                $registroB->borrado ='0';
                $registroB->res_traslado = $traslado_res_traslado;
                $registroB->resolucion_traslado = $archivo;
                $registroB->matricula_id = $registro->id;
                $registroB->tipo ='1';

                $registroB->save();
            }

            $registroC = new Domicilio;

            $registroC->anio = $cicloActivo->year;
            $registroC->direccion = $alumno->direccion;
            $registroC->lugar = $alumno->lugar;
            $registroC->departamento = $alumno->departamento;
            $registroC->provincia = $alumno->provincia;
            $registroC->distrito = $alumno->distrito;
            $registroC->telefono = $alumno->telefono;
            $registroC->alumno_id = $alumno->id;
            $registroC->activo = '1';
            $registroC->borrado = '0';
            $registroC->matricula_id = $registro->id;
            
            $registroC->save();

            //Registro de Apoderado Principal de Matricula
            foreach ($apoderados as $apoderado) {
                if($apoderado->principal == "1"){

                    $registroD = new ApoderadoMatricula;

                    $registroD->alumno_id = $alumno->id;
                    $registroD->matricula_id = $registro->id;
                    $registroD->apellido_paterno = $apoderado->apellido_materno;
                    $registroD->apellido_materno = $apoderado->apellido_paterno;
                    $registroD->nombres = $apoderado->nombres;
                    $registroD->parentesco = $apoderado->tipo_apoderado;
                    $registroD->fecha_nac = $apoderado->fecha_nacimiento;
                    $registroD->instruccion = $apoderado->grado_instruccion;
                    $registroD->ocupacion = $apoderado->ocupacion;
                    $registroD->direccion = $apoderado->direccion;
                    $registroD->telefono = $apoderado->telefono;
                    $registroD->activo = '1';
                    $registroD->borrado = '0';

                    $registroD->save();
                }
            }

            $msj='Matrícula del Alumno(a) Registrada con Éxito';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        
    }

    public function generatePDF()
    {

        $users = User::get();
  
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ]; 
            
        $pdf = PDF::loadView('myPDF', $data);
        $pdf->setPaper('A4', 'landscape');
        $pdf->setOption('defaultFont', 'Arial');
     
        return $pdf->download('itsolutionstuff.pdf');
    }

    public function verPDF()
    {

        $users = User::get();
  
        $data = [
            'title' => 'Welcome to ItSolutionStuff.com',
            'date' => date('m/d/Y'),
            'users' => $users
        ]; 

        $title = 'Welcome to ItSolutionStuff.com';
        $date = date('m/d/Y');
        
            
        /* $pdf = PDF::loadView('myPDF', $data);
        $pdf->setPaper('A4', 'landscape'); */
     
        return view('myPDF',compact('users','title','date'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $alumno_id = $request->alumno_id;
        $matricula = json_decode(stripslashes($request->matricula));
        $traslado = json_decode(stripslashes($request->traslado));


        //Binding Data

        $cicloActivo = CicloEscolar::GetCicloActivo();

        if(!$cicloActivo){
            $result='0';
            $msj='No se cuenta con un Año Escolar Lectivo Activo, contacte con el administrador del sistema';
            $selector='cbuciclo_escolar_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $alumno = Alumno::find($alumno_id);

        if(!$alumno){
            $result='0';
            $msj='Seleccione un alumno';
            $selector='txtalumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $estado = 1;
        $matri_es_traslado = isset($matricula->es_traslado) ? $matricula->es_traslado : null;
        $matri_responsable_matricula_nombres = isset($matricula->responsable_matricula_nombres) ? $matricula->responsable_matricula_nombres : null;
        $matri_cargo_responsable = isset($matricula->cargo_responsable) ? $matricula->cargo_responsable : null;
        $matri_ciclo_seccion_id = isset($matricula->ciclo_seccion_id) ? $matricula->ciclo_seccion_id : null;
        $matri_trabaja = isset($matricula->trabaja) ? $matricula->trabaja : null;
        $matri_activo = isset($matricula->activo) ? $matricula->activo : null;
        
        $traslado_motivo = isset($traslado->motivo) ? $traslado->motivo : null;
        $traslado_codigo_modular = isset($traslado->codigo_modular) ? $traslado->codigo_modular : null;
        $traslado_ie_nombre = isset($traslado->ie_nombre) ? $traslado->ie_nombre : null;
        $traslado_res_traslado = isset($traslado->res_traslado) ? $traslado->res_traslado : null;


        $input1  = array('matri_es_traslado' => $matri_es_traslado);
        $reglas1 = array('matri_es_traslado' => 'required');

        $input2  = array('matri_responsable_matricula_nombres' => $matri_responsable_matricula_nombres);
        $reglas2 = array('matri_responsable_matricula_nombres' => 'required');

        $input3  = array('matri_cargo_responsable' => $matri_cargo_responsable);
        $reglas3 = array('matri_cargo_responsable' => 'required');

        $input4  = array('matri_ciclo_seccion_id' => $matri_ciclo_seccion_id);
        $reglas4 = array('matri_ciclo_seccion_id' => 'required');

        $input5  = array('matri_trabaja' => $matri_trabaja);
        $reglas5 = array('matri_trabaja' => 'required');

        $input6  = array('matri_activo' => $matri_activo);
        $reglas6 = array('matri_activo' => 'required');

        $input7  = array('traslado_motivo' => $traslado_motivo);
        $reglas7 = array('traslado_motivo' => 'required');

        $input8  = array('traslado_codigo_modular' => $traslado_codigo_modular);
        $reglas8 = array('traslado_codigo_modular' => 'required');

        $input9  = array('traslado_ie_nombre' => $traslado_ie_nombre);
        $reglas9 = array('traslado_ie_nombre' => 'required');

        $input10  = array('traslado_res_traslado' => $traslado_res_traslado);
        $reglas10 = array('traslado_res_traslado' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);
        $validator6 = Validator::make($input6, $reglas6);
        $validator7 = Validator::make($input7, $reglas7);
        $validator8 = Validator::make($input8, $reglas8);
        $validator9 = Validator::make($input9, $reglas9);
        $validator10 = Validator::make($input10, $reglas10);

        if ($validator1->fails())
        {
            $result='0';
            $msj='Debe de seleccionar si el alumno es traslado';
            $selector='cbumatri_es_traslado';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails())
        {
            $result='0';
            $msj='Debe de ingresar el responsable de la matricula';
            $selector='txtmatri_responsable_matricula_nombres';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails())
        {
            $result='0';
            $msj='Debe ingresar el cargo del responsable de la matricula';
            $selector='txtmatri_cargo_responsable';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator4->fails() || intval($matri_ciclo_seccion_id) == 0)
        {
            $result='0';
            $msj='Debe de seleccionar la seccion del alumno';
            $selector='cbumatri_ciclo_seccion_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        

        if (($validator8->fails() || strlen(strval($traslado_codigo_modular)) != 7) && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el código modular de la IE de procedencia del alumno, debe de tener 7 dígitos';
            $selector='txttraslado_codigo_modular';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator9->fails() && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el nombre de la IE de procedencia del alumno';
            $selector='txttraslado_ie_nombre';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator10->fails() && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el nombre de la Resolución de traslado';
            $selector='txttraslado_res_traslado';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator7->fails() && intval($matri_es_traslado) == 1)
        {
            $result='0';
            $msj='Debe ingresar el motivo del traslado';
            $selector='txttraslado_motivo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $archivo="";
        $file = $request->archivo;
        $segureFile=0;

        $oldImg = isset($traslado->resolucion_traslado) ? $traslado->resolucion_traslado : null;;

        if(intval($matri_es_traslado) == 1){
            if($request->hasFile('archivo')){

                $nombreArchivo=$request->nombrefile;

                $aux2='documento_'.date('d-m-Y').'-'.date('H-i-s');
                $input2  = array('archivo' => $file) ;
                $reglas2 = array('archivo' => 'required|file:1,1024000');
                $validatorF = Validator::make($input2, $reglas2);     

                if ($validatorF->fails())
                {
                    $segureFile=1;
                    $msj="El archivo adjunto ingresado tiene un tamaño superior a 100 MB, ingrese otro archivo o limpie el formulario";
                    $result='0';
                    $selector='archivo';
                }
                else
                {
                    $nombre2=$file->getClientOriginalName();
                    $extension2=$file->getClientOriginalExtension();
                    $nuevoNombre2=$aux2.".".$extension2;
                    //$subir2=Storage::disk('infoFile')->put($nuevoNombre2, \File::get($file));

                    if($extension2=="pdf"|| $extension2=="PDF")
                    {

                        $subir2=false;
                        $subir2=Storage::disk('documentoMatricula')->put($nuevoNombre2, \File::get($file));

                    if($subir2){
                        $archivo=$nuevoNombre2;
                    }
                    else{
                        $msj="Error al subir el archivo adjunto, intentelo nuevamente luego";
                        $segureFile=1;
                        $result='0';
                        $selector='archivo';
                    }
                    }
                    else {
                        $segureFile=1;
                        $msj="El archivo adjunto ingresado tiene una extensión no válida, ingrese otro archivo o limpie el formulario";
                        $result='0';
                        $selector='archivo';
                    }
                }

            }   
        }   

        if($segureFile==1){
            Storage::disk('documentoMatricula')->delete($archivo);
        }
        else{

            $vive_madre = 0;
            $vive_padre = 0;

            $apoderados = Apoderado::where('alumno_id',$alumno_id)
                            ->where('activo',1)
                            ->where('borrado',0)
                            ->get();

            foreach ($apoderados as $apoderado) {
                if($apoderado->tipo_apoderado_id == 1){
                    $vive_madre = $apoderado->vive;
                }
                if($apoderado->tipo_apoderado_id == 2){
                    $vive_padre = $apoderado->vive;
                }
            }

            $tiene_discapacidad = 0;

            if(intval($alumno->DI) == 1 ||
                intval($alumno->DA) == 1 ||
                intval($alumno->DV) == 1 ||
                intval($alumno->DM) == 1 ||
                intval($alumno->SC) == 1 ||
                intval($alumno->OT) == 1 )
                {
                    $tiene_discapacidad = 1;
                }

            $fecha = date("Y-m-d");

            if(0 == intval($alumno->estado_grado) && null == $alumno->anio_ingreso){
                $contMatriculas = Matricula::where('alumno_id', $alumno->id)->count();

                if($contMatriculas == 0){

                    $ie = InstitucionEducativa::where('borrado','0')
                                            ->where('activo','1')
                                            ->first();

                    $alumnoSave = Alumno::find($alumno->id);

                    $alumnoSave->estado_grado = '1';
                    $alumnoSave->anio_ingreso = $cicloActivo->year;
                    $alumnoSave->codigo_modular = $ie->codigo_modular;

                    $numMatricula = 1;
                    $flag = 0;

                    $countAlumnosYear = Alumno::where('anio_ingreso', $cicloActivo->year)->count();

                    while ($countAlumnosYear >= 10000) {
                        $countAlumnosYear -=10000; 
                        $flag++;
                    }
                    $numMatricula += $countAlumnosYear;

                    $alumnoSave->numero_matricula = $numMatricula;
                    $alumnoSave->flag = $flag;

                    $alumnoSave->save();
                }
            }

            $registro = Matricula::find($id);

            $registro->estado = $estado;
            $registro->es_traslado = $matri_es_traslado;
            $registro->tiene_discapacidad = $tiene_discapacidad;
            $registro->vive_madre = $vive_madre;
            $registro->vive_padre = $vive_padre;
            $registro->responsable_matricula_nombres = strtoupper($matri_responsable_matricula_nombres);
            $registro->cargo_responsable = strtoupper($matri_cargo_responsable);
            $registro->ciclo_seccion_id = $matri_ciclo_seccion_id;
            $registro->trabaja = $matri_trabaja;
            $registro->activo='1';
            $registro->borrado='0';
            $registro->DI = $alumno->DI;
            $registro->DA = $alumno->DA;
            $registro->DV = $alumno->DV;
            $registro->DM = $alumno->DM;
            $registro->SC = $alumno->SC;
            $registro->OT = $alumno->OT;
            $registro->validado_apoderado='1';
            $registro->validado_director='1';
            $registro->fecha_valid_apo = $fecha;
            $registro->fecha_valid_dir = $fecha;

            $registro->save();

            $registroB = Traslado::where('matricula_id', $registro->id)
                                ->where('tipo', '1')
                                ->where('activo', '1')
                                ->where('borrado', '0')
                                ->first();

            if($registroB != null && intval($matri_es_traslado) == 1){

                if(strlen($archivo)>0){
                    Storage::disk('documentoMatricula')->delete($oldImg);
                    $registroB->resolucion_traslado = $archivo;
                }

                $registroB->fecha = $fecha;
                $registroB->motivo = $traslado_motivo;
                $registroB->codigo_modular = $traslado_codigo_modular;
                $registroB->ie_nombre = strtoupper($traslado_ie_nombre);
                $registroB->res_traslado = $traslado_res_traslado;
                
                $registroB->matricula_id = $registro->id;
                $registroB->tipo ='1';

                $registroB->save();

            }

            if($registroB != null && intval($matri_es_traslado) != 1){
                Storage::disk('documentoMatricula')->delete($oldImg);
                $registroB->delete();

            }

            if($registroB == null && intval($matri_es_traslado) == 1){

                $registroB = new Traslado;

                $registroB->fecha = $fecha;
                $registroB->motivo = $traslado_motivo;
                $registroB->codigo_modular = $traslado_codigo_modular;
                $registroB->ie_nombre = strtoupper($traslado_ie_nombre);
                $registroB->alumno_id = $alumno->id;
                $registroB->activo ='1';
                $registroB->borrado ='0';
                $registroB->res_traslado = $traslado_res_traslado;
                $registroB->resolucion_traslado = $archivo;
                $registroB->matricula_id = $registro->id;
                $registroB->tipo ='1';

                $registroB->save();
            }

            $registroC = Domicilio::where('matricula_id', $registro->id)->where('activo', '1')->where('borrado', '0')->first();

            if($registroC != null){
                
                $registroC->direccion = $alumno->direccion;
                $registroC->lugar = $alumno->lugar;
                $registroC->departamento = $alumno->departamento;
                $registroC->provincia = $alumno->provincia;
                $registroC->distrito = $alumno->distrito;
                $registroC->telefono = $alumno->telefono;
                
                $registroC->save();
            }

            //Registro de Apoderado Principal de Matricula
            foreach ($apoderados as $apoderado) {
                if($apoderado->principal == "1"){

                    $registroD = ApoderadoMatricula::where('matricula_id', $registro->id)->where('activo', '1')->where('borrado', '0')->first();

                    $registroD->apellido_paterno = $apoderado->apellido_materno;
                    $registroD->apellido_materno = $apoderado->apellido_paterno;
                    $registroD->nombres = $apoderado->nombres;
                    $registroD->parentesco = $apoderado->tipo_apoderado;
                    $registroD->fecha_nac = $apoderado->fecha_nacimiento;
                    $registroD->instruccion = $apoderado->grado_instruccion;
                    $registroD->ocupacion = $apoderado->ocupacion;
                    $registroD->direccion = $apoderado->direccion;
                    $registroD->telefono = $apoderado->telefono;

                    $registroD->save();
                }
            }

            $msj='Matrícula del Alumno(a) Modificado con Éxito';
        }

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result='1';
        $msj='1';
        
        $registro = Matricula::find($id);
        
        $registroA = Alumno::find($registro->alumno_id);
        $registroA->estado_grado = $registroA->old_estado_grado;
        $registroA->save();
        
        $registroB = Traslado::where('matricula_id', $registro->id)
        ->where('tipo', '1')
                            ->where('activo', '1')
                            ->where('borrado', '0')
                            ->first();
                            
                            if($registroB != null){
                                Storage::disk('documentoMatricula')->delete($registroB->resolucion_traslado);
                                $registroB->delete();
                            }
                            
                            $registroC = Domicilio::where('matricula_id', $registro->id)->where('activo', '1')->where('borrado', '0')->first();
                            
        if($registroC != null){
            $registroC->delete();
        }
        
        $registroD = ApoderadoMatricula::where('matricula_id', $registro->id)->where('activo', '1')->where('borrado', '0')->first();
        
        if($registroD != null){
            $registroD->delete();
        }
        
        if($registro != null){
            $registro->delete();
        }
        
        
        $msj='La Matrícula fue Anulada exitosamente';
        
        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
    
    public function promover(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $matricula_id = $request->v1;

        //validar notas
        $notasAlumno = Nota::GetCalificacionesAlumno($matricula_id);

        //return $notasAlumno;

        if($notasAlumno->error){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        $faltaCompletarNotas = false;
        $msj='Debe completar las Notas del Curso(s): ';
        foreach ($notasAlumno->matricula->cursos as $key => $curso) {
            if(!$curso->notaFinal){
                $faltaCompletarNotas = true;
                $msj.= " ".$curso->curso;
            }
        }

        if($faltaCompletarNotas){
            $result='0';
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        //fin validar notas
        
        //process
        $result = Matricula::PromoverAlumno($matricula_id);

        if(!$result){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        //fin process

        $msj='Se completó la Promosión del Alumno Adecuadamente';
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$matricula_id]);

    }
    
    public function permanecer(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $matricula_id = $request->v1;

        //validar notas
        $notasAlumno = Nota::GetCalificacionesAlumno($matricula_id);

        //return $notasAlumno;

        if($notasAlumno->error){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        $faltaCompletarNotas = false;
        $msj='Debe completar las Notas del Curso(s): ';
        foreach ($notasAlumno->matricula->cursos as $key => $curso) {
            if(!$curso->notaFinal){
                $faltaCompletarNotas = true;
                $msj.= " ".$curso->curso;
            }
        }

        if($faltaCompletarNotas){
            $result='0';
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        //fin validar notas
        
        //process
        $result = Matricula::PermanecerAlumno($matricula_id);

        if(!$result){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        //fin process

        $msj='Se completó la Permanencia del Alumno en el Grado Adecuadamente';
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$matricula_id]);

    }

    public function expulsar(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $matricula_id = $request->v1;

        //validar notas
       /*  $notasAlumno = Nota::GetCalificacionesAlumno($matricula_id);

        //return $notasAlumno;

        if($notasAlumno->error){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        $faltaCompletarNotas = false;
        $msj='Debe completar las Notas del Curso(s): ';
        foreach ($notasAlumno->matricula->cursos as $key => $curso) {
            if(!$curso->notaFinal){
                $faltaCompletarNotas = true;
                $msj.= " ".$curso->curso;
            }
        }

        if($faltaCompletarNotas){
            $result='0';
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */

        //fin validar notas
        
        //process
        $result = Matricula::ExpulsarAlumno($matricula_id);

        if(!$result){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        //fin process

        $msj='Se completó la Expulsión del Alumno Adecuadamente';
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$matricula_id]);

    }

    public function cancelconclusion(Request $request)
    {
        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $matricula_id = $request->v1;

        //validar notas
       /*  $notasAlumno = Nota::GetCalificacionesAlumno($matricula_id);

        //return $notasAlumno;

        if($notasAlumno->error){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        $faltaCompletarNotas = false;
        $msj='Debe completar las Notas del Curso(s): ';
        foreach ($notasAlumno->matricula->cursos as $key => $curso) {
            if(!$curso->notaFinal){
                $faltaCompletarNotas = true;
                $msj.= " ".$curso->curso;
            }
        }

        if($faltaCompletarNotas){
            $result='0';
            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        } */

        //fin validar notas
        
        //process
        $result = Matricula::CancelConclusionAlumno($matricula_id);

        if(!$result){
            $result='0';
            $msj='Error de Procesamiento, contacte un administrador';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }
        //fin process

        $msj='Se completó la Cancelación de la Conlusión del Alumno Adecuadamente';
        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$matricula_id]);

    }

    public function buscarMasivo(Request $request)
    {
        $result='1';
        $msj='';
        $selector='';

        $nivel=$request->nivel;
        $grado=$request->grado;
        $seccion=$request->seccion;
        $responsable_matricula_nombres=$request->responsable_matricula_nombres;
        $fecha=$request->fecha;

        $result='1';
        $msj='';
        $selector='';


        $input1  = array('nivel' => $nivel);
        $reglas1 = array('nivel' => 'required');

        $input2  = array('grado' => $grado);
        $reglas2 = array('grado' => 'required');

        $input3  = array('seccion' => $seccion);
        $reglas3 = array('seccion' => 'required');

        $input4  = array('responsable_matricula_nombres' => $responsable_matricula_nombres);
        $reglas4 = array('responsable_matricula_nombres' => 'required');

        $input5  = array('fecha' => $fecha);
        $reglas5 = array('fecha' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);
        $validator3 = Validator::make($input3, $reglas3);
        $validator4 = Validator::make($input4, $reglas4);
        $validator5 = Validator::make($input5, $reglas5);

        if ($validator1->fails() || intval($nivel) <= 0)
        {
            $result='0';
            $msj='Debe Seleccionar el Nivel';
            $selector='cbunivel';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails() || intval($grado) <= 0)
        {
            $result='0';
            $msj='Debe Seleccionar el Grado';
            $selector='cbugrado';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator3->fails() || intval($seccion) <= 0)
        {
            $result='0';
            $msj='Debe Seleccionar la Sección';
            $selector='cbuseccion';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }



        if ($validator4->fails())
        {
            $result='0';
            $msj='Debe de ingresar el Responsable de Matrícula';
            $selector='txtresponsable_matricula_nombres';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator5->fails())
        {
            $result='0';
            $msj='Debe de ingresar la Fecha de Matrícula';
            $selector='cbutipo';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $registros = Matricula::GetDatosPendientesBySeccion($seccion);
        $cicloActivoLast = CicloEscolar::GetCicloActivoLast();

        $dataCabecera = Matricula::GetDatosActualesBySeccionLast($seccion, $grado, $nivel);

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector,'registros'=>$registros,'cicloActivoLast'=>$cicloActivoLast,'dataCabecera'=>$dataCabecera]);
    }


    public function storeMasivo(Request $request){

        ini_set('memory_limit','256M');

        $result='0';
        $msj='Se tuvo un error en el proceso, comunicarse con el Administrador';
        $selector='';

        $cabecera = json_decode(stripslashes($request->cabecera));
        $registros = json_decode(stripslashes($request->registros));
        $dataRepetir = json_decode(stripslashes($request->dataRepetir));
        $dataPromover = json_decode(stripslashes($request->dataPromover));

        foreach ($registros as $key => $alumno) {
            //flow Repitente
            if($alumno->estado_grado == 3){
                Matricula::MatriculaRapida($alumno, $cabecera, $dataRepetir);
            }
            //flow Repitente
            elseif($alumno->estado_grado == 2){
                Matricula::MatriculaRapida($alumno, $cabecera, $dataPromover);
            }
        }

        $result='1';
        $msj='Se realizó la Matrícula Masiva de Forma Exitosa';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector, 'registros'=>$registros]);
    }


    public function VerificarApoderado(Request $request){

        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $idM = $request->idM;

        $input1  = array('idM' => $idM);
        $reglas1 = array('idM' => 'required');

        $validator1 = Validator::make($input1, $reglas1);

        if ($validator1->fails() || intval($idM) <= 0)
        {
            $result='0';
            $msj='Debe Remitir el Alumno Correctamente';
            $selector='txtidM';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $hoy = date('Y-m-d');

        $registro = Matricula::find($idM);

        $registro->fecha_valid_apo = $hoy;
        $registro->validado_apoderado = '1';

        $registro->save();

        $msj='Se realizó la Validación de la Matrícula de Forma Exitosa';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function VerificarDirector(Request $request){

        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $idM = $request->idM;

        $input1  = array('idM' => $idM);
        $reglas1 = array('idM' => 'required');

        $validator1 = Validator::make($input1, $reglas1);

        if ($validator1->fails() || intval($idM) <= 0)
        {
            $result='0';
            $msj='Debe Remitir el Alumno Correctamente';
            $selector='txtidM';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $hoy = date('Y-m-d');

        $registro = Matricula::find($idM);

        $registro->estado = '1';
        $registro->fecha_valid_dir = $hoy;
        $registro->validado_director = '1';

        $registro->save();

        $msj='Se realizó la Validación de la Matrícula de Forma Exitosa';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function AsignarTutor(Request $request){

        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $ciclo_seccion_id = $request->ciclo_seccion_id;
        $tutor_id = $request->tutor_id;

        $input1  = array('ciclo_seccion_id' => $ciclo_seccion_id);
        $reglas1 = array('ciclo_seccion_id' => 'required');

        $input2  = array('tutor_id' => $tutor_id);
        $reglas2 = array('tutor_id' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails() || intval($ciclo_seccion_id) <= 0)
        {
            $result='0';
            $msj='Debe Remitir la Sección  Correctamente';
            $selector='cbuciclo_seccion_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails() || intval($tutor_id) <= 0)
        {
            $result='0';
            $msj='Debe Remitir el Docente Correctamente';
            $selector='cbututor_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $hoy = date('Y-m-d');

        $registro = CicloSeccion::find($ciclo_seccion_id);

        $registro->tutor_id = $tutor_id;
        $registro->save();

        $msj='Se realizó la Asignación del Tutor de Forma Exitosa';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }

    public function ActualizarTutor(Request $request){

        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $ciclo_seccion_id = $request->ciclo_seccion_id;
        $tutor_id = $request->tutor_id;

        $input1  = array('ciclo_seccion_id' => $ciclo_seccion_id);
        $reglas1 = array('ciclo_seccion_id' => 'required');

        $input2  = array('tutor_id' => $tutor_id);
        $reglas2 = array('tutor_id' => 'required');

        $validator1 = Validator::make($input1, $reglas1);
        $validator2 = Validator::make($input2, $reglas2);

        if ($validator1->fails() || intval($ciclo_seccion_id) <= 0)
        {
            $result='0';
            $msj='Debe Remitir la Sección  Correctamente';
            $selector='cbuciclo_seccion_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        if ($validator2->fails() || intval($tutor_id) <= 0)
        {
            $result='0';
            $msj='Debe Remitir el Docente Correctamente';
            $selector='cbututor_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }

        $hoy = date('Y-m-d');

        $registro = CicloSeccion::find($ciclo_seccion_id);

        $registro->tutor_id = $tutor_id;
        $registro->save();

        $msj='Se realizó la  Actualización del Tutor de Forma Exitosa';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }
    
    public function destroyTutor($id)
    {
        $result='1';
        $msj='1';
        
        $registro = CicloSeccion::find($id);
        $registro->tutor_id = null;
        $registro->save();
        
        $msj='Se eliminó la Asignación del Tutor de Forma Exitosa';
        
        return response()->json(["result"=>$result,'msj'=>$msj]);
    }
    
    public function RegistrarApreciacion(Request $request){

        ini_set('memory_limit','256M');

        $result='1';
        $msj='';
        $selector='';

        $id = $request->id;
        $aprecia_tutor_1 = $request->aprecia_tutor_1;
        $aprecia_tutor_2 = $request->aprecia_tutor_2;
        $aprecia_tutor_3 = $request->aprecia_tutor_3;

        $input1  = array('id' => $id);
        $reglas1 = array('id' => 'required');

        $validator1 = Validator::make($input1, $reglas1);

        if ($validator1->fails() || intval($id) <= 0)
        {
            $result='0';
            $msj='Debe Remitir al Alumno Correctamente';
            $selector='alumno_id';

            return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
        }


        //$hoy = date('Y-m-d');

        $registro = Matricula::find($id);

        $registro->aprecia_tutor_1 = $aprecia_tutor_1;
        $registro->aprecia_tutor_2 = $aprecia_tutor_2;
        $registro->aprecia_tutor_3 = $aprecia_tutor_3;
        $registro->save();

        $msj='Se realizó el registro de Apresiación del Tutor de Forma Exitosa';

        return response()->json(["result"=>$result,'msj'=>$msj,'selector'=>$selector]);
    }


    
}
