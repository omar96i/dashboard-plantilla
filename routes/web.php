<?php

use App\Exports\UsersExport;
use App\Http\Controllers\Cotizaciones\CotizacionController;
use App\Http\Controllers\Productos\ProductoController;
use App\Http\Controllers\Usuarios\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Configuraciones\ConfiguracionController;
use App\Http\Controllers\Cotizaciones\CotizacionTemplateController;
use App\Http\Controllers\DolarValorController;
use App\Http\Controllers\Productos\CategoriaController;
use App\Http\Controllers\Proyectos\ProyectoController;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Contracts\Role;
use Maatwebsite\Excel\Facades\Excel;

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
});

Route::redirect('/', '/login', 301);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'TRM'], function () {
        Route::post('/store', [DolarValorController::class, 'storeTRM'])->name('trm.store');
        Route::get('/get', [DolarValorController::class, 'getTRM'])->name('trm.get');
    });

    Route::group(['prefix' => 'Cotizaciones'], function () {
        Route::get('/', [CotizacionController::class, 'index'])->name('cotizaciones.index');
        Route::get('/form', [CotizacionController::class, 'form'])->name('cotizaciones.form');
    });

    Route::group(['prefix' => 'Productos'], function () {
        Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
        Route::post('/store', [ProductoController::class, 'store'])->name('productos.store');
        Route::get('/getAll', [ProductoController::class, 'getAll'])->name('productos.get-all');
        Route::get('/delete/{producto}', [ProductoController::class, 'delete'])->name('productos.delete');
        Route::get('/get/{producto}', [ProductoController::class, 'get'])->name('productos.get');
        Route::post('/update/{producto}', [ProductoController::class, 'update'])->name('productos.update');
        Route::group(['prefix' => 'Categorias'], function () {
            Route::post('/store', [CategoriaController::class, 'store'])->name('productos.categorias.store');
            Route::post('/update/{categoria}', [CategoriaController::class, 'update'])->name('productos.categorias.update');
            Route::get('/get', [CategoriaController::class, 'get'])->name('productos.categorias.get');
            Route::get('/get/{categoria}', [CategoriaController::class, 'getCategoria'])->name('productos.categorias.get-categoria');
            Route::get('/delete/{categoria}', [CategoriaController::class, 'delete'])->name('productos.categorias.delete');
        });
    });

    Route::group(['prefix' => 'Usuarios'], function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::post('/store', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::post('/update/{user}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::get('/delete/{user}', [UsuarioController::class, 'delete'])->name('usuarios.delete');
        Route::get('/get/{user}', [UsuarioController::class, 'get'])->name('usuarios.get');
        Route::get('/getAll', [UsuarioController::class, 'getAll'])->name('usuarios.get-all');
    });

    Route::group(['prefix' => 'Cotizaciones'], function () {
        Route::get('/', [CotizacionController::class, 'index'])->name('cotizaciones.index');
        Route::get('/getValorGeneral/{cotizacion}', [CotizacionController::class, 'getValorGeneral'])->name('cotizaciones.get-valor-general');
        Route::get('/show/{cotizacion}', [CotizacionController::class, 'show'])->name('cotizaciones.show');
        Route::get('/get', [CotizacionController::class, 'get'])->name('cotizaciones.get');
        Route::get('/getAll', [CotizacionController::class, 'getAll'])->name('cotizaciones.get-all');
        Route::get('/getEnabled', [CotizacionController::class, 'getEnabled'])->name('cotizaciones.get-enabled');
        Route::get('/form', [CotizacionController::class, 'form'])->name('cotizaciones.form');
        Route::get('/edit/{cotizacion}', [CotizacionController::class, 'edit'])->name('cotizaciones.edit');
        Route::post('/store', [CotizacionController::class, 'store'])->name('cotizaciones.store');
        Route::get('/delete/{cotizacion}', [CotizacionController::class, 'delete'])->name('cotizaciones.delete');
        Route::post('/update/{cotizacion}', [CotizacionController::class, 'update'])->name('cotizaciones.update');
        Route::post('/update/subCotizacion/{sub_cotizacion}', [CotizacionController::class, 'updateSubCotizacion'])->name('cotizaciones.update.sub-cotizacion');
        Route::post('/store/{cotizacion}', [CotizacionController::class, 'storeSubCotizacion'])->name('cotizaciones.store.sub-cotizacion');
        Route::get('/get/{cotizacion}', [CotizacionController::class, 'getSubCotizaciones'])->name('cotizaciones.get.sub-cotizacion');
        Route::get('/get/subCotizacion/{sub_cotizacion}', [CotizacionController::class, 'getSubCotizacionOnly'])->name('cotizaciones.get.sub-cotizacion-only');
        Route::post('/store/product/{sub_cotizacion}', [CotizacionController::class, 'storeProduct'])->name('cotizaciones.store.product');
        Route::get('/delete/subCotizacion/{sub_cotizacion}', [CotizacionController::class, 'deleteSubCotizacion'])->name('cotizaciones.delete.sub-cotizacion');
        Route::get('/delete/producto/{producto}', [CotizacionController::class, 'deleteProducto'])->name('cotizaciones.delete.producto');
        Route::post('/update/producto/{producto}', [CotizacionController::class, 'updateProducto'])->name('cotizaciones.update.producto');
        Route::get('/delete/producto/{producto}', [CotizacionController::class, 'deleteProducto'])->name('cotizaciones.delete.producto');
        Route::get('/Abonos/get/{cotizacion}', [CotizacionController::class, 'getAbonos'])->name('cotizaciones.get.abonos');
        Route::post('/Abonos/store/{cotizacion}', [CotizacionController::class, 'storeAbonos'])->name('cotizaciones.store.abonos');
        Route::get('/Abonos/delete/{abono}', [CotizacionController::class, 'deleteAbono'])->name('cotizaciones.delete.abonos');
        Route::group(['prefix' => 'Templates'], function () {
            Route::get('/store/{cotizacion}', [CotizacionTemplateController::class, 'store'])->name('cotizaciones.store.template');

        });
    });

    Route::group(['prefix' => 'Proyectos'], function () {
        Route::get('/', [ProyectoController::class, 'index'])->name('proyectos.index');
        Route::get('/get', [ProyectoController::class, 'get'])->name('proyectos.get');
        Route::post('/store', [ProyectoController::class, 'store'])->name('proyectos.store');
        Route::post('/edit/{proyecto}', [ProyectoController::class, 'edit'])->name('proyectos.edit');
        Route::get('/form/{proyecto?}', [ProyectoController::class, 'form'])->name('proyectos.form');

    });

    Route::group(['prefix' => 'Configuraciones'], function () {
        Route::get('/', [ConfiguracionController::class, 'index'])->name('configuraciones.index');
        Route::post('/storeIva', [ConfiguracionController::class, 'storeIva'])->name('configuraciones.store.iva');
        Route::get('/getIva', [ConfiguracionController::class, 'getIva'])->name('configuraciones.get.iva');
        Route::post('/storeDatosBasicos', [ConfiguracionController::class, 'storeDatosBasicos'])->name('configuraciones.store.datos-basicos');
        Route::get('/getDatosBasicos', [ConfiguracionController::class, 'getDatosBasicos'])->name('configuraciones.get.datos-basicos');
    });

});


