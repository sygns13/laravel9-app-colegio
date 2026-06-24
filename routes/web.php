<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\ShowPosts;
use App\Http\Controllers\ClientePromocionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    //return view('welcome');
    return redirect()->route('login');
});

// Formulario PÚBLICO (sin autenticación) de registro de clientes para la
// campaña de promociones / novedades. Va fuera del prefijo /admin a propósito.
Route::get('/registro-cliente', [ClientePromocionController::class, 'index1'])->name('promociones.registro');
Route::post('/registro-cliente', [ClientePromocionController::class, 'store'])->name('promociones.registro.store');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /* Route::get('/dashboard', ShowPosts::class)->name('dashboard'); */

    //Pasar parametros
    /* Route::get('prueba/{name}',ShowPosts::class); */
});
