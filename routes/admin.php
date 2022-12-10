<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SeccionesController;
use App\Http\Controllers\Admin\InstitucionEducativaController;
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
    Route::get('/ie', [InstitucionEducativaController::class, 'index1'])->name('ie');
    Route::get('/secciones', [SeccionesController::class, 'index1'])->name('secciones');
    Route::get('/cursos', [CursoController::class, 'index1'])->name('cursos');
    Route::get('/docentes', [DocenteController::class, 'index1'])->name('docentes');
    Route::get('/ciclo', [CicloEscolarController::class, 'index1'])->name('ciclo');
    Route::get('/horario', [HorarioController::class, 'index1'])->name('horario');
    Route::get('/horas', [HoraController::class, 'index1'])->name('horas');
    Route::get('/matriculas', [MatriculaController::class, 'index1'])->name('matriculas');
    Route::get('/nominas', [MatriculaController::class, 'index2'])->name('nominas');
    Route::get('/asignacion-cursos', [AsignacionCursoController::class, 'index1'])->name('asignacion-cursos');
    Route::get('/asistencia-docente', [DocenteAsistenciaDiaController::class, 'index1'])->name('asistencia-docente');
    Route::get('/lista-alumnos', [DocenteController::class, 'index2'])->name('lista-alumnos');
    Route::get('/asistencia', [AsistenciaController::class, 'index1'])->name('asistencia');
    Route::get('/reporte-horarios', [HorarioController::class, 'index2'])->name('reporte-horarios');
    Route::get('/asistencia-sesiones', [AsistenciaController::class, 'index2'])->name('asistencia-sevsiones');
    Route::get('/calificacion', [NotaController::class, 'index1'])->name('index1');
    Route::get('/calificaciones', [NotaController::class, 'index2'])->name('index2');

    Route::resource('/resecciones', SeccionesController::class);
    Route::resource('/reie', InstitucionEducativaController::class);
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

    Route::get('/renominas', [MatriculaController::class, 'indexNomina'])->name('renominas');
    Route::get('/rehorarioget', [HorarioController::class, 'indexReporte'])->name('rehorarioget');
    Route::get('/asistenciasesionget', [AsistenciaController::class, 'indexAsistenciaSesion'])->name('asistenciasesionget');
    Route::get('/calificacionesget', [NotaController::class, 'indexCalificacion'])->name('calificacionesget');


    Route::get('/redocentes/altabajadocente/{id}/{var}',[DocenteController::class, 'altabaja'])->name('altabajadocente');
    Route::get('/reciclo/activarMatricula/{id}',[CicloEscolarController::class, 'activarMatricula'])->name('activarMatricula');
    Route::get('/reciclo/desactivarMatricula/{id}',[CicloEscolarController::class, 'desactivarMatricula'])->name('desactivarMatricula');
    Route::get('/reciclo/cerrarCicloEscolar/{id}',[CicloEscolarController::class, 'cerrarCicloEscolar'])->name('cerrarCicloEscolar');
    Route::get('/rematricula/getCicloSeccion/{gradoMaster_id}',[MatriculaController::class, 'getCicloSeccion'])->name('getCicloSeccion');
    Route::get('/rematricula/getmatriculaactiva/{alumno_id}',[MatriculaController::class, 'getMatriculaActiva'])->name('getMatriculaActiva');
    Route::get('/regetlista-alumnos',[DocenteController::class, 'getListaAlumnos'])->name('getListaAlumnos');
    Route::get('/regetlista-alumnos-asignacion',[DocenteController::class, 'getListaAlumnosAsignacion'])->name('getListaAlumnosAsignacion');

    Route::get('/generate-pdf', [MatriculaController::class, 'generatePDF']);
    Route::get('/ver-pdf', [ReportPDFController::class, 'verPDF']);
    Route::get('/d-pdf', [ReportPDFController::class, 'descargarPDF']);

    Route::get('/realumnobuscar/buscar/{tipo_documento_id}/{num_documento}',[AlumnoController::class, 'buscarAlumno'])->name('buscarAlumno');




    //Reportes PDF
    Route::get('/reportepdf/ficha-matricula/{alumno_id}',[ReportPDFController::class, 'impFichaMatricula'])->name('impFichaMatricula');
    Route::get('/reportepdf/nomina-matricula/{ciclo_seccion_id}',[ReportPDFController::class, 'impNominaMatricula'])->name('impNominaMatricula');
    Route::get('/reportepdf/horario-seccion/{ciclo_seccion_id}',[ReportPDFController::class, 'impHorarioSeccion'])->name('impHorarioSeccion');
    Route::get('/reportepdf/asistencia-sesiones/{ciclo_seccion_id}/{fecha}',[ReportPDFController::class, 'impAsistenciaSesion'])->name('impAsistenciaSesion');

});
