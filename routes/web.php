<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\ScannerController;
use App\Http\Controllers\CostosfijosController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/nuevo/servicio/', function () {
    return view('admin.servicios.create');
});



Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('roles.show');
    Route::get('/roles/create', [App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles/create', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
    Route::patch('/roles/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
    Route::delete('/roles/delete/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('destroy.roles');

    Route::resource('permisos', PermisosController::class);
    Route::resource('users', UserController::class);

    // =============== M O D U L O   C L I E N T S ===============================
    Route::get('/clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients.index');
    Route::post('/clients/create', [App\Http\Controllers\ClientController::class, 'store'])->name('clients.store');
    Route::patch('/clients/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/delete/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('clients.destroy');

    // =============== M O D U L O  T A L L E R ===============================
    Route::post('/producto', [App\Http\Controllers\TallerController::class, 'store_product'])->name('product.store_product');


    Route::get('/admin/taller', [App\Http\Controllers\TallerController::class, 'index'])->name('taller.index');
    Route::get('/admin/taller/create', [App\Http\Controllers\TallerController::class, 'create'])->name('taller.create');
    Route::post('/admin/taller/store', [App\Http\Controllers\TallerController::class, 'store'])->name('taller.store');
    Route::get('/admin/taller/edit/{id}', [App\Http\Controllers\TallerController::class, 'edit'])->name('taller.edit');
    Route::patch('/admin/taller/update/{id}', [App\Http\Controllers\TallerController::class, 'update'])->name('taller.update');
    Route::patch('/admin/taller/status/{id}', [App\Http\Controllers\TallerController::class, 'edit_status'])->name('taller.edit_status');
    Route::patch('/admin/precio/servicio/{id}', [App\Http\Controllers\TallerController::class, 'update_precio_servicio'])->name('taller.precio_servicio');
    Route::patch('/admin/precio/product/{id}', [App\Http\Controllers\TallerController::class, 'update_precio_product'])->name('taller.precio_product');
    Route::delete('/admin/taller/delete/{id}', [App\Http\Controllers\TallerController::class, 'destroy'])->name('taller.destroy');
    Route::delete('/products_taller/{id}', [App\Http\Controllers\TallerController::class, 'destroy_products'])->name('products_taller.destroy');

    Route::get('/imprimir_etiqueta/{id}', [App\Http\Controllers\TallerController::class, 'imprimir'])->name('imprimir.create');

    /*|--------------------------------------------------------------------------
    |Scanner
    |--------------------------------------------------------------------------*/

    Route::get('scanner_servicios', [App\Http\Controllers\ScannerController::class, 'index'])->name('scanner.index');
    Route::get('scanner_productos', [App\Http\Controllers\ScannerController::class, 'index_products'])->name('scanner_products.index');

    Route::get('scanner/search', [App\Http\Controllers\ScannerController::class, 'search'])->name('scanner.search');
    Route::get('scanner/search/product', [App\Http\Controllers\ScannerController::class, 'search_product'])->name('scanner_product.search');

    Route::get('scanner/caja', [App\Http\Controllers\ScannerController::class, 'caja'])->name('caja.search');

    Route::patch('/scanner_servicio/edit/{id}', [App\Http\Controllers\ScannerController::class, 'edit_servicio'])->name('scanner_servicio.edit');
    Route::patch('/scanner_product/edit/{id}', [App\Http\Controllers\ScannerController::class, 'edit_product'])->name('scanner_product.edit');
    Route::delete('/scanner_product/delete/{id}', [App\Http\Controllers\ScannerController::class, 'delete_product'])->name('scanner_product.delete');

    /*|--------------------------------------------------------------------------
    |Caja
    |--------------------------------------------------------------------------*/

    Route::get('/caja', [App\Http\Controllers\CajaController::class, 'index'])->name('index.caja');
    Route::get('caja_search', [App\Http\Controllers\CajaController::class, 'caja_search'])->name('caja_search.caja');

    Route::post('/admin/caja/create', [App\Http\Controllers\CajaController::class, 'store'])->name('caja.store');

    /*|--------------------------------------------------------------------------
    |Configuracion
    |--------------------------------------------------------------------------*/

    Route::get('/configuracion/index', [App\Http\Controllers\ConfiguracionController::class, 'index'])->name('index.configuracion');
    Route::patch('/configuracion/update', [App\Http\Controllers\ConfiguracionController::class, 'update'])->name('update.configuracion');

    /*|--------------------------------------------------------------------------
    |Productos
    |--------------------------------------------------------------------------*/
    Route::post('/create/product', [App\Http\Controllers\WooController::class, 'store'])->name('product_woo.store');
    Route::get('products', [App\Http\Controllers\WooController::class, 'index'])->name('product_woo.index');
    Route::post('/productos/buscar', [App\Http\Controllers\WooController::class, 'search'])->name('productos.buscar');

    Route::post('/admin/products/import', [App\Http\Controllers\WooController::class, 'import_products'])->name('products.import');

    /*|--------------------------------------------------------------------------
    |Colores
    |--------------------------------------------------------------------------*/
    Route::post('costos/create', [CostosfijosController::class, 'create'])->name('costos.create');
    Route::post('costos/update/{id}', [CostosfijosController::class, 'update_costos'])->name('costos.update_costos');

});

Route::get('/taller/view/{id}', [App\Http\Controllers\TallerController::class, 'show'])->name('taller.show');

