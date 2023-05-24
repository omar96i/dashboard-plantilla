<?php

use App\Exports\UsersExport;
use App\Http\Controllers\Cotizaciones\CotizacionController;
use App\Http\Controllers\Productos\ProductoController;
use App\Http\Controllers\Usuarios\UsuarioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Configuraciones\ConfiguracionController;
use App\Http\Controllers\Cotizaciones\CotizacionFileController;
use App\Http\Controllers\Cotizaciones\CotizacionTemplateController;
use App\Http\Controllers\DolarValorController;
use App\Http\Controllers\FileUploadController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\Productos\CategoriaController;
use App\Http\Controllers\Productos\ProductoReabastecimientoController;
use App\Http\Controllers\Proyectos\ProyectoActividadAsistenciaController;
use App\Http\Controllers\Proyectos\ProyectoActividadController;
use App\Http\Controllers\Proyectos\ProyectoActividadProductoSolicitudController;
use App\Http\Controllers\Proyectos\ProyectoActividadReagendamientoController;
use App\Http\Controllers\Proyectos\ProyectoActividadReporteController;
use App\Http\Controllers\Proyectos\ProyectoController;
use App\Http\Controllers\Proyectos\ProyectoInterventoriaController;
use App\Http\Controllers\Proyectos\ProyectoPlanoController;
use App\Http\Controllers\Role\RoleController;
use App\Models\Cotizaciones\SubCotizacionProducto;
use App\Models\Proyectos\Proyecto;
use App\Models\Proyectos\ProyectoActividad;
use App\Models\Proyectos\ProyectoActividadProducto;
use App\Models\Proyectos\ProyectoActividadReporte;
use App\Models\Proyectos\ProyectoPlano;
use App\Models\Users\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;

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
    $user = User::find(1);
    return $user->hasPermissionTo('usuario.view');
});

Route::redirect('/', '/login', 301);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/upload', [FileUploadController::class, 'showUploadForm']);
Route::post('/upload', [FileUploadController::class, 'storeUploads']);


Route::middleware(['auth'])->group(function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'TRM'], function () {
        Route::post('/store', [DolarValorController::class, 'storeTRM'])->name('trm.store');
        Route::get('/get', [DolarValorController::class, 'getTRM'])->name('trm.get');
    });

    Route::group(['prefix' => 'Notificaciones'], function () {
        Route::get('/index/{tipo?}', [NotificacionController::class, 'index'])->name('notificaciones.index');
        Route::get('/readAll', [NotificacionController::class, 'readAll'])->name('notificaciones.read.all');
        Route::get('/read/{id}', [NotificacionController::class, 'read'])->name('notificaciones.read');
        Route::get('/show/{id}', [NotificacionController::class, 'show'])->name('notificaciones.show');

    });


    Route::group(['prefix' => 'Roles'], function () {
        Route::get('/', [RoleController::class, 'index'])->name('roles.index');
        Route::get('/get', [RoleController::class, 'get'])->name('roles.get');
        Route::get('/get/permisos/{role}', [RoleController::class, 'getRolePermisos'])->name('roles.get.permisos.role');
        Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
        Route::get('/delete/{role}', [RoleController::class, 'delete'])->name('roles.delete');
        Route::post('/store/permisos/{role}', [RoleController::class, 'storeRolePermisos'])->name('roles.store.permisos');
        Route::group(['prefix' => 'Permisos'], function () {
            Route::get('/delete/{permiso}', [RoleController::class, 'deletePermiso'])->name('roles.permisos.delete');
            Route::post('/store', [RoleController::class, 'storePermiso'])->name('roles.permisos.store');
            Route::get('/get', [RoleController::class, 'getPermisos'])->name('roles.permisos.get');
        });
    });

    Route::group(['prefix' => 'Productos'], function () {
        Route::get('/', [ProductoController::class, 'index'])->name('productos.index');
        Route::post('/store', [ProductoController::class, 'store'])->name('productos.store');
        Route::post('/store/import', [ProductoController::class, 'storeExcel'])->name('productos.store.import');
        Route::get('/getAll', [ProductoController::class, 'getAll'])->name('productos.get-all');
        Route::get('/delete/{producto}', [ProductoController::class, 'delete'])->name('productos.delete');
        Route::post('/delete/img/{producto}', [ProductoController::class, 'deleteImg'])->name('productos.delete.img');
        Route::get('/get/{producto}', [ProductoController::class, 'get'])->name('productos.get');
        Route::post('/update/{producto}', [ProductoController::class, 'update'])->name('productos.update');

        Route::group(['prefix' => 'Categorias'], function () {
            Route::post('/store', [CategoriaController::class, 'store'])->name('productos.categorias.store');
            Route::post('/update/{categoria}', [CategoriaController::class, 'update'])->name('productos.categorias.update');
            Route::get('/get', [CategoriaController::class, 'get'])->name('productos.categorias.get');
            Route::get('/get/{categoria}', [CategoriaController::class, 'getCategoria'])->name('productos.categorias.get-categoria');
            Route::get('/delete/{categoria}', [CategoriaController::class, 'delete'])->name('productos.categorias.delete');
        });
        Route::group(['prefix' => 'Reabastecimientos'], function () {
            Route::get('/', [ProductoReabastecimientoController::class, 'index'])->name('productos.reabastecimientos.index');
            Route::get('/get', [ProductoReabastecimientoController::class, 'get'])->name('productos.reabastecimientos.get');
            Route::post('/store', [ProductoReabastecimientoController::class, 'store'])->name('productos.reabastecimientos.store');
            Route::get('/delete/{producto}', [ProductoReabastecimientoController::class, 'delete'])->name('productos.reabastecimientos.delete');
        });
    });


    Route::group(['prefix' => 'Usuarios'], function () {
        Route::get('/', [UsuarioController::class, 'index'])->name('usuarios.index');
        Route::post('/get/permisos', [UsuarioController::class, 'getPermisos'])->name('usuarios.get.permisos');
        Route::view('/profile', 'usuarios.profile')->name('usuarios.profile');
        Route::post('/store', [UsuarioController::class, 'store'])->name('usuarios.store');
        Route::post('/update/{user}', [UsuarioController::class, 'update'])->name('usuarios.update');
        Route::post('/update/foto/{informacion_personal}', [UsuarioController::class, 'updateFoto'])->name('usuarios.update.foto');
        Route::post('/update/password/{user}', [UsuarioController::class, 'updatePassword'])->name('usuarios.update.password');
        Route::post('/update/informacionPersonal/{informacion_personal}', [UsuarioController::class, 'updateInformacionPersonal'])->name('usuarios.update.foto');
        Route::get('/delete/{user}', [UsuarioController::class, 'delete'])->name('usuarios.delete');
        Route::get('/get/{user}', [UsuarioController::class, 'get'])->name('usuarios.get');
        Route::get('/getUser', [UsuarioController::class, 'getUser'])->name('usuarios.get.user');
        Route::get('/getAll', [UsuarioController::class, 'getAll'])->name('usuarios.get-all');
    });

    Route::group(['prefix' => 'Cotizaciones'], function () {
        Route::get('/', [CotizacionController::class, 'index'])->name('cotizaciones.index');
        Route::get('/getValorGeneral/{cotizacion}', [CotizacionController::class, 'getValorGeneral'])->name('cotizaciones.get-valor-general');
        Route::get('/show/{cotizacion}', [CotizacionController::class, 'show'])->name('cotizaciones.show');
        Route::get('/get', [CotizacionController::class, 'get'])->name('cotizaciones.get');
        Route::get('/Dolar/get/{dolar}', [CotizacionController::class, 'getDolar'])->name('cotizaciones.dolar.get');
        Route::post('/Dolar/update/{cotizacion}', [CotizacionController::class, 'updateDolar'])->name('cotizaciones.dolar.update');
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
        Route::get('/Abonos/update/estado/{abono}', [CotizacionController::class, 'updateAbono'])->name('cotizaciones.update.estado.abonos');


        Route::group(['prefix' => 'Templates'], function () {
            Route::get('/store/{cotizacion}', [CotizacionTemplateController::class, 'store'])->name('cotizaciones.store.template');
        });

        Route::group(['prefix' => 'Files'], function () {
            Route::post('/store/{cotizacion}', [CotizacionFileController::class, 'store'])->name('cotizaciones.store.files');
            Route::get('/get/{cotizacion}', [CotizacionFileController::class, 'get'])->name('cotizaciones.get.files');
            Route::get('/delete/{file}', [CotizacionFileController::class, 'delete'])->name('cotizaciones.delete.files');
        });
    });

    Route::group(['prefix' => 'Proyectos'], function () {
        Route::get('/', [ProyectoController::class, 'index'])->name('proyectos.index');
        Route::get('/get', [ProyectoController::class, 'get'])->name('proyectos.get');
        Route::get('/show/{proyecto}', [ProyectoController::class, 'show'])->name('proyectos.show');
        Route::post('/store', [ProyectoController::class, 'store'])->name('proyectos.store');
        Route::post('/edit/{proyecto}', [ProyectoController::class, 'edit'])->name('proyectos.edit');
        Route::get('/form/{proyecto?}', [ProyectoController::class, 'form'])->name('proyectos.form');
        Route::get('/form/aux/{cotizacion}', [ProyectoController::class, 'formAux'])->name('proyectos.form.aux');
        Route::get('/Inventario/get/{proyecto}', [ProyectoController::class, 'getInventario'])->name('proyectos.inventario.get');
        Route::get('/planos', [ProyectoPlanoController::class, 'index'])->name('proyectos.planos');

        Route::group(['prefix' => 'Planos'], function () {
            Route::post('/store', [ProyectoPlanoController::class, 'store'])->name('proyectos.planos.store');
            Route::get('/get', [ProyectoPlanoController::class, 'get'])->name('proyectos.planos.get');
            Route::get('/delete/{proyecto_plano}', [ProyectoPlanoController::class, 'delete'])->name('proyectos.planos.delete');
        });

        Route::group(['prefix' => 'PlanosAdmin'], function () {
            Route::get('/index', [ProyectoPlanoController::class, 'indexAdmin'])->name('proyectos.planos.admin.index');
            Route::get('/get', [ProyectoPlanoController::class, 'getAdmin'])->name('proyectos.planos.admin.get');
            Route::post('/aprobar/{proyecto_plano}', [ProyectoPlanoController::class, 'aprobar'])->name('proyectos.planos.admin.aprobar');
            Route::post('/rechazar/{proyecto_plano}', [ProyectoPlanoController::class, 'rechazar'])->name('proyectos.planos.admin.rechazar');
        });

        Route::group(['prefix' => 'Actividades'], function () {
            Route::get('/', [ProyectoActividadController::class, 'index'])->name('proyectos.actividades.index');
            Route::get('/tecnico', [ProyectoActividadController::class, 'indexTecnico'])->name('proyectos.actividades.tecnico.index');
            Route::get('/show/{actividad}', [ProyectoActividadController::class, 'show'])->name('proyectos.actividades.show');
            Route::get('/get', [ProyectoActividadController::class, 'get'])->name('proyectos.actividades.get');
            Route::post('/store/pruebas/{actividad}', [ProyectoActividadController::class, 'uploadPruebas'])->name('proyectos.actividades.upload.pruebas');
            Route::get('/Finalizar/{actividad}', [ProyectoActividadController::class, 'finalizarActividad'])->name('proyectos.actividades.finalizar');
            Route::put('/cambiarEstado/{actividad}', [ProyectoActividadController::class, 'cambiarEstado'])->name('proyectos.actividades.cambiar-estado');
            Route::get('/get/{actividad}', [ProyectoActividadController::class, 'getActividad'])->name('proyectos.actividades.get.actividad');
            Route::get('/calendario', [ProyectoActividadController::class, 'calendario'])->name('proyectos.actividades.calendario');
            Route::get('/getActividadesUsuario', [ProyectoActividadController::class, 'getActividadesUsuario'])->name('proyectos.actividades.get-actividades-usuario');
            Route::get('/delete/{actividad}', [ProyectoActividadController::class, 'delete'])->name('proyectos.actividades.delete');
            Route::get('/form/{actividad?}', [ProyectoActividadController::class, 'form'])->name('proyectos.actividades.form');
            Route::post('/store', [ProyectoActividadController::class, 'store'])->name('proyectos.actividades.store');
            Route::post('/update/{actividad}', [ProyectoActividadController::class, 'update'])->name('proyectos.actividades.update');
            Route::post('/Files/store', [ProyectoActividadController::class, 'storeFiles'])->name('proyectos.actividades.files.store');
            Route::get('/Files/delete/{file}', [ProyectoActividadController::class, 'deleteFiles'])->name('proyectos.actividades.files.delete');
            Route::get('/Files/get/{actividad}', [ProyectoActividadController::class, 'getFiles'])->name('proyectos.actividades.files.get');
            Route::post('/Inventario/store/{actividad}', [ProyectoActividadController::class, 'storeInventario'])->name('proyectos.actividades.inventario.store');
            Route::get('/Inventario/get/{actividad}', [ProyectoActividadController::class, 'getInventario'])->name('proyectos.actividades.inventario.get');

            Route::group(['prefix' => 'Reportes'], function () {
                Route::get('/', [ProyectoActividadReporteController::class, 'index'])->name('proyectos.actividades.reportes.index');
                Route::get('/get', [ProyectoActividadReporteController::class, 'get'])->name('proyectos.actividades.reportes.get');
                Route::get('/confirm/{reporte}', [ProyectoActividadReporteController::class, 'confirm'])->name('proyectos.actividades.reportes.confirm');
                Route::get('/cancel/{reporte}', [ProyectoActividadReporteController::class, 'cancel'])->name('proyectos.actividades.reportes.cancel');
                Route::post('/store/{actividad}', [ProyectoActividadReporteController::class, 'store'])->name('proyectos.actividades.reportes.store');
            });

            Route::group(['prefix' => 'Solicitudes'], function () {
                Route::get('/', [ProyectoActividadProductoSolicitudController::class, 'index'])->name('proyectos.actividades.solicitudes.index');
                Route::get('/show', [ProyectoActividadProductoSolicitudController::class, 'show'])->name('proyectos.actividades.solicitudes.show');
                Route::get('/get', [ProyectoActividadProductoSolicitudController::class, 'get'])->name('proyectos.actividades.solicitudes.get');
                Route::get('/update/{solicitud}/{estado}', [ProyectoActividadProductoSolicitudController::class, 'updateEstado'])->name('proyectos.actividades.solicitudes.update-estado');

                Route::post('/store/{actividad}', [ProyectoActividadProductoSolicitudController::class, 'store'])->name('proyectos.actividades.solicitudes.store');
            });

            Route::group(['prefix' => 'Reagendamientos'], function () {
                Route::get('/', [ProyectoActividadReagendamientoController::class, 'index'])->name('proyectos.actividades.reagendamientos.index');
                Route::get('/get', [ProyectoActividadReagendamientoController::class, 'get'])->name('proyectos.actividades.reagendamientos.get');
                Route::post('/store/{actividad}', [ProyectoActividadReagendamientoController::class, 'store'])->name('proyectos.actividades.reagendamientos.store');
            });

            Route::group(['prefix' => 'Asistencias'], function () {
                Route::get('/', [ProyectoActividadAsistenciaController::class, 'index'])->name('proyectos.actividades.asistencias.index');
                Route::get('/get', [ProyectoActividadAsistenciaController::class, 'get'])->name('proyectos.actividades.asistencias.get');

                Route::post('/store/{actividad}', [ProyectoActividadAsistenciaController::class, 'store'])->name('proyectos.actividades.asistencias.store');
            });
        });

        Route::group(['prefix' => 'Interventorias'], function () {
            Route::get('/', [ProyectoInterventoriaController::class, 'index'])->name('proyectos.interventoria.index');
            Route::get('/show/{interventoria}', [ProyectoInterventoriaController::class, 'show'])->name('proyectos.interventoria.show');
            Route::get('/pdf/{interventoria}', [ProyectoInterventoriaController::class, 'pdf'])->name('proyectos.interventoria.pdf');
            Route::get('/get', [ProyectoInterventoriaController::class, 'get'])->name('proyectos.interventoria.get');
            Route::get('/get/{interventoria}', [ProyectoInterventoriaController::class, 'getOne'])->name('proyectos.interventoria.get.one');
            Route::post('/store', [ProyectoInterventoriaController::class, 'store'])->name('proyectos.interventoria.store');
            Route::post('/store/files/{interventoria}', [ProyectoInterventoriaController::class, 'storeFiles'])->name('proyectos.interventoria.store.files');
            Route::post('/store/firma/{interventoria}', [ProyectoInterventoriaController::class, 'storeFirma'])->name('proyectos.interventoria.store.firma');
            Route::post('/update/{interventoria}', [ProyectoInterventoriaController::class, 'update'])->name('proyectos.interventoria.update');
        });
    });

    Route::group(['prefix' => 'Configuraciones'], function () {
        Route::get('/', [ConfiguracionController::class, 'index'])->name('configuraciones.index');
        Route::post('/storeIva', [ConfiguracionController::class, 'storeIva'])->name('configuraciones.store.iva');
        Route::get('/getIva', [ConfiguracionController::class, 'getIva'])->name('configuraciones.get.iva');
        Route::post('/storeDatosBasicos', [ConfiguracionController::class, 'storeDatosBasicos'])->name('configuraciones.store.datos-basicos');
        Route::get('/getDatosBasicos', [ConfiguracionController::class, 'getDatosBasicos'])->name('configuraciones.get.datos-basicos');
    });

});


