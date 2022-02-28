<?php

use App\Http\Controllers\Cotizaciones\CotizacionController;
use App\Http\Controllers\Productos\ProductoController;
use App\Http\Controllers\Usuarios\UsuarioController;
use Illuminate\Support\Facades\Route;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

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

Route::get('/test', function () {
    return QrCode::generate(route('cotizaciones.index'), '../public/qrcodes/qrcode.svg');
});
Route::view('/', 'index')->name('home');

Route::group(['prefix' => 'Cotizaciones'], function () {
    Route::get('/', [CotizacionController::class, 'index'])->name('cotizaciones.index');
    Route::get('/form', [CotizacionController::class, 'form'])->name('cotizaciones.form');
});

Route::group(['prefix' => 'Productos'], function () {
    Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
});

Route::group(['prefix' => 'Usuarios'], function () {
    Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
    Route::post('/store', [UsuarioController::class, 'store'])->name('usuarios.store');
    Route::post('/update/{user}', [UsuarioController::class, 'update'])->name('usuarios.update');
    Route::get('/delete/{user}', [UsuarioController::class, 'delete'])->name('usuarios.delete');
    Route::get('/get/{user}', [UsuarioController::class, 'get'])->name('usuarios.get');
    Route::get('/getAll', [UsuarioController::class, 'getAll'])->name('usuarios.get-all');

});
