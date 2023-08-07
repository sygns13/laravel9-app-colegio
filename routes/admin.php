<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SeccionesController;
use App\Http\Controllers\Admin\InstitucionEducativaController;
use App\Http\Controllers\Admin\LegajoController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\CompetenciaController;
use App\Http\Controllers\Admin\IndicadorController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\CicloEscolarController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\HoraController;
use App\Http\Controllers\Admin\MatriculaController;
use App\Http\Controllers\Admin\AlumnoController;
use App\Http\Controllers\Admin\AsignacionCursoController;
use App\Http\Controllers\Admin\DocenteAsistenciaDiaController;
use App\Http\Controllers\Admin\AsistenciaDocenteController;
use App\Http\Controllers\Admin\AsistenciaController;
use App\Http\Controllers\Admin\AsistenciaAlumnoController;
use App\Http\Controllers\Admin\NotaController;
use App\Http\Controllers\Admin\ResolucionController;


use App\Http\Controllers\Admin\ReportPDFController;
/* Route::get('admin', function () {
        return "Holi boli";
})->name('user');

 */

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/', [HomeController::class, 'index'])->name('admin');
    Route::get('/legajo', [HomeController::class, 'legajo'])->name('legajo');
    Route::get('/legajo-fichas', [HomeController::class, 'legajoFichas'])->name('legajo-fichas');
    Route::get('/ie', [InstitucionEducativaController::class, 'index1'])->name('ie');
    Route::get('/secciones', [SeccionesController::class, 'index1'])->name('secciones');
    Route::get('/cursos', [CursoController::class, 'index1'])->name('cursos');
    Route::get('/docentes', [DocenteController::class, 'index1'])->name('docentes');
    Route::get('/ciclo', [CicloEscolarController::class, 'index1'])->name('ciclo');
    Route::get('/horario', [HorarioController::class, 'index1'])->name('horario');
    Route::get('/horas', [HoraController::class, 'index1'])->name('horas');
    Route::get('/matriculas', [MatriculaController::class, 'index1'])->name('matriculas');
    Route::get('/nominas', [MatriculaController::class, 'index2'])->name('nominas');
    Route::get('/docnominas', [MatriculaController::class, 'index3'])->name('docnominas');
    Route::get('/asignacion-cursos', [AsignacionCursoController::class, 'index1'])->name('asignacion-cursos');
    Route::get('/asistencia-docente', [DocenteAsistenciaDiaController::class, 'index1'])->name('asistencia-docente');
    Route::get('/lista-alumnos', [DocenteController::class, 'index2'])->name('lista-alumnos');
    Route::get('/lista-cursos', [DocenteController::class, 'index3'])->name('lista-cursos');
    Route::get('/asistencia', [AsistenciaController::class, 'index1'])->name('asistencia');
    Route::get('/reporte-horarios', [HorarioController::class, 'index2'])->name('reporte-horarios');
    Route::get('/asistencia-sesiones', [AsistenciaController::class, 'index2'])->name('asistencia-sesiones');
    Route::get('/calificacion', [NotaController::class, 'index1'])->name('index1');
    Route::get('/calificaciones', [NotaController::class, 'index2'])->name('index2');
    Route::get('/conclusion-matriculas', [NotaController::class, 'index3'])->name('index3');
    Route::get('/reporte-doc-horarios', [HorarioController::class, 'index3'])->name('indexDocHorario');
    Route::get('/asistencia-doc-sesiones', [AsistenciaController::class, 'index3'])->name('asistencia-doc-sesiones');

    Route::get('/legajo-nuevo', [HomeController::class, 'legajoNuevo2'])->name('legajo-nuevo');

    Route::get('/listado-cursos', [AlumnoController::class, 'index2'])->name('listado-cursos');
    Route::get('/horario-alumno', [AlumnoController::class, 'index3'])->name('horario-alumno');
    Route::get('/asistencia-alumno', [AlumnoController::class, 'index4'])->name('asistencia-alumno');
    Route::get('/resoluciones', [ResolucionController::class, 'index1'])->name('resoluciones');
    

    Route::resource('/resecciones', SeccionesController::class);
    Route::resource('/reie', InstitucionEducativaController::class);
    Route::resource('/relegajo', LegajoController::class);
    Route::resource('/recursos', CursoController::class);
    Route::resource('/recompetencias', CompetenciaController::class);
    Route::resource('/reindicadores', IndicadorController::class);
    Route::resource('/redocentes', DocenteController::class);
    Route::resource('/reciclo', CicloEscolarController::class);
    Route::resource('/rehorario', HorarioController::class);
    Route::resource('/rehora', HoraController::class);
    Route::resource('/rematricula', MatriculaController::class);
    Route::resource('/remalumno', AlumnoController::class);
    Route::resource('/reasignacion-cursos', AsignacionCursoController::class);
    Route::resource('/redocente-asistencia-dia', DocenteAsistenciaDiaController::class);
    Route::resource('/reasistencia-docente', AsistenciaDocenteController::class);
    Route::resource('/reasistencia', AsistenciaController::class);
    Route::resource('/reasistencia-alumno', AsistenciaAlumnoController::class);
    Route::resource('/renotas', NotaController::class);
    Route::resource('/reresolucion', ResolucionController::class);

    Route::get('/renominas', [MatriculaController::class, 'indexNomina'])->name('renominas');
    Route::get('/redocnominas', [MatriculaController::class, 'indexDocNomina'])->name('redocnominas');
    Route::get('/rehorarioget', [HorarioController::class, 'indexReporte'])->name('rehorarioget');
    Route::get('/asistenciasesionget', [AsistenciaController::class, 'indexAsistenciaSesion'])->name('asistenciasesionget');
    Route::get('/calificacionesget', [NotaController::class, 'indexCalificacion'])->name('calificacionesget');
    Route::get('/redocentemain', [DocenteController::class, 'indexDocenteMain'])->name('redocentemain');
    Route::get('/redocentedocumentos', [DocenteController::class, 'getDocumentos'])->name('redocentedocumentos');
    Route::get('/rehorariogetdoc', [HorarioController::class, 'indexDocHorario'])->name('indexDocHorario');
    Route::get('/asistenciasesiongetdoc', [AsistenciaController::class, 'indexDocAsistenciaSesion'])->name('asistenciasesiongetdoc');
    Route::get('/realumnomain', [AlumnoController::class, 'indexAlumnoMain'])->name('indexAlumnoMain');
    


    Route::get('/redocentes/altabajadocente/{id}/{var}',[DocenteController::class, 'altabaja'])->name('altabajadocente');
    Route::get('/reciclo/activarMatricula/{id}',[CicloEscolarController::class, 'activarMatricula'])->name('activarMatricula');
    Route::get('/reciclo/desactivarMatricula/{id}',[CicloEscolarController::class, 'desactivarMatricula'])->name('desactivarMatricula');
    Route::get('/reciclo/cerrarCicloEscolar/{id}',[CicloEscolarController::class, 'cerrarCicloEscolar'])->name('cerrarCicloEscolar');
    Route::get('/rematricula/getCicloSeccion/{gradoMaster_id}',[MatriculaController::class, 'getCicloSeccion'])->name('getCicloSeccion');
    Route::get('/rematricula/getmatriculaactiva/{alumno_id}',[MatriculaController::class, 'getMatriculaActiva'])->name('getMatriculaActiva');
    Route::get('/regetlista-alumnos',[DocenteController::class, 'getListaAlumnos'])->name('getListaAlumnos');
    Route::get('/regetlista-alumnos-asignacion',[DocenteController::class, 'getListaAlumnosAsignacion'])->name('getListaAlumnosAsignacion');
    Route::get('/regetlista-cursos',[DocenteController::class, 'getListaCrusos'])->name('getListaCrusos');
    Route::delete('/regetlista-cursos/{id}',[DocenteController::class, 'deletePlanAnual'])->name('deletePlanAnual');
    Route::put('/regetlista-cursos/{id}',[DocenteController::class, 'AddPlanAnual'])->name('AddPlanAnual');
    Route::put('/reasistencia-validar/{id}',[AsistenciaController::class, 'validarAsistencia'])->name('validarAsistencia');
    Route::put('/relegajo-update-director/{id}',[LegajoController::class, 'updateDirector'])->name('relegajo-update-director');

    Route::get('/generate-pdf', [MatriculaController::class, 'generatePDF']);
    Route::get('/ver-pdf', [ReportPDFController::class, 'verPDF']);
    Route::get('/d-pdf', [ReportPDFController::class, 'descargarPDF']);

    Route::get('/realumnobuscar/buscar/{tipo_documento_id}/{num_documento}',[AlumnoController::class, 'buscarAlumno'])->name('buscarAlumno');

    Route::get('/get-lista-cursos', [AlumnoController::class, 'GetListaCursos'])->name('get-lista-cursos');
    Route::get('/get-horario', [AlumnoController::class, 'GetHorario'])->name('get-horario');
    Route::get('/get-asistencia', [AlumnoController::class, 'GetAsistencia'])->name('get-asistencia');

    Route::get('/get-resoluciones1', [ResolucionController::class, 'indexGetData1'])->name('get-resoluciones1');
    Route::get('/get-resoluciones2', [ResolucionController::class, 'indexGetData2'])->name('get-resoluciones2');




    //Reportes PDF
    Route::get('/reportepdf/ficha-matricula/{alumno_id}',[ReportPDFController::class, 'impFichaMatricula'])->name('impFichaMatricula');
    Route::get('/reportepdf/nomina-matricula/{ciclo_seccion_id}',[ReportPDFController::class, 'impNominaMatricula'])->name('impNominaMatricula');
    Route::get('/reportepdf/horario-seccion/{ciclo_seccion_id}',[ReportPDFController::class, 'impHorarioSeccion'])->name('impHorarioSeccion');
    Route::get('/reportepdf/asistencia-sesiones/{ciclo_seccion_id}/{fecha}',[ReportPDFController::class, 'impAsistenciaSesion'])->name('impAsistenciaSesion');
    Route::get('/reportepdf/calificaciones-seccion/{ciclo_seccion_id}',[ReportPDFController::class, 'impFichaCalificacionesSeccion'])->name('impFichaCalificacionesSeccion');
    Route::get('/reportepdf/calificaciones-alumno/{matricula_id}',[ReportPDFController::class, 'impFichaCalificacionesAlumno'])->name('impFichaCalificacionesAlumno');
    Route::get('/reportepdf/calificaciones-curso/{matricula_id}/{ciclo_curso_id}',[ReportPDFController::class, 'impFichaCalificacionesAlumnoCurso'])->name('impFichaCalificacionesAlumnoCurso');
    
    //Alumno
    //Route::get('/reportepdf/calificacion-alumno/{matricula_id}/{ciclo_curso_id}',[ReportPDFController::class, 'impFichaCalificacionesAlumnoCurso'])->name('impFichaCalificacionesAlumnoCurso');
    Route::get('/reportepdf/asistencia-sesiones-alumno/{ciclo_id}/{fecha}/{alumno_id}',[ReportPDFController::class, 'impAsistenciaSesionAlumno'])->name('impAsistenciaSesionAlumno');


    Route::post('/matricula/promover', [MatriculaController::class, 'promover'])->name('promover');
    Route::post('/matricula/permanecer', [MatriculaController::class, 'permanecer'])->name('permanecer');
    Route::post('/matricula/expulsar', [MatriculaController::class, 'expulsar'])->name('expulsar');
    Route::post('/matricula/cancelconclusion', [MatriculaController::class, 'cancelconclusion'])->name('cancelconclusion');

    Route::post('/relegajoUpdate/FotoPerfil', [LegajoController::class, 'updatefotoperfil'])->name('relegajoUpdate');
    Route::post('/relegajoUpdate/FotoMision', [LegajoController::class, 'updatefotomision'])->name('updatefotomision');
    Route::post('/relegajoUpdate/FotoVision', [LegajoController::class, 'updatefotovision'])->name('updatefotovision');

    Route::post('/redocentes/generateusername', [DocenteController::class, 'generateusername'])->name('generateusername');
    Route::post('/redocenteUpdate/FotoPerfil', [DocenteController::class, 'updatefotoperfil'])->name('redocenteUpdate');

    Route::post('/regfecha-calificacion', [NotaController::class, 'programarFecha'])->name('programarFecha');

    Route::post('/realumnoUpdate/FotoPerfil', [AlumnoController::class, 'updatefotoperfil'])->name('realumnoUpdate');

});
