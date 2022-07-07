<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\SeccionesController;
use App\Http\Controllers\Admin\InstitucionEducativaController;


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

    Route::resource('/resecciones', SeccionesController::class);
    Route::resource('/reie', InstitucionEducativaController::class);

});
