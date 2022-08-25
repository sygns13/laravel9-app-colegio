<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SeccionesController;
use App\Http\Controllers\Admin\InstitucionEducativaController;
use App\Http\Controllers\Admin\CursoController;
use App\Http\Controllers\Admin\CompetenciaController;
use App\Http\Controllers\Admin\DocenteController;
use App\Http\Controllers\Admin\CicloEscolarController;
use App\Http\Controllers\Admin\HorarioController;
use App\Http\Controllers\Admin\HoraController;
use App\Http\Controllers\Admin\MatriculaController;
use App\Http\Controllers\Admin\AlumnoController;


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

    Route::resource('/resecciones', SeccionesController::class);
    Route::resource('/reie', InstitucionEducativaController::class);
    Route::resource('/recursos', CursoController::class);
    Route::resource('/recompetencias', CompetenciaController::class);
    Route::resource('/redocentes', DocenteController::class);
    Route::resource('/reciclo', CicloEscolarController::class);
    Route::resource('/rehorario', HorarioController::class);
    Route::resource('/rehora', HoraController::class);
    Route::resource('/rematricula', MatriculaController::class);
    Route::resource('/remalumno', AlumnoController::class);

    Route::get('redocentes/altabajadocente/{id}/{var}',[DocenteController::class, 'altabaja'])->name('altabajadocente');
    Route::get('reciclo/activarMatricula/{id}',[CicloEscolarController::class, 'activarMatricula'])->name('activarMatricula');
    Route::get('reciclo/desactivarMatricula/{id}',[CicloEscolarController::class, 'desactivarMatricula'])->name('desactivarMatricula');
    Route::get('reciclo/cerrarCicloEscolar/{id}',[CicloEscolarController::class, 'cerrarCicloEscolar'])->name('cerrarCicloEscolar');
    Route::get('rematricula/getCicloSeccion/{gradoMaster_id}',[MatriculaController::class, 'getCicloSeccion'])->name('getCicloSeccion');
    Route::get('rematricula/getmatriculaactiva/{alumno_id}',[MatriculaController::class, 'getMatriculaActiva'])->name('getMatriculaActiva');

    Route::get('generate-pdf', [MatriculaController::class, 'generatePDF']);
    Route::get('ver-pdf', [MatriculaController::class, 'verPDF']);

    Route::get('realumnobuscar/buscar/{tipo_documento_id}/{num_documento}',[AlumnoController::class, 'buscarAlumno'])->name('buscarAlumno');

});
