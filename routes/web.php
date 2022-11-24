<?php

use App\Http\Controllers\Admin\CategoriasController;
use App\Http\Controllers\Admin\CategoriasgeneralesController;
use App\Http\Controllers\Admin\DetallesController;
use App\Http\Controllers\Admin\PedidosController;
use App\Http\Controllers\Admin\ProductosController;
use App\Http\Controllers\Admin\SubcategoriasController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsuariosController;
use App\Http\Controllers\Admin\ProveedoresController;
use App\Http\Controllers\Proveedores\Panelproveedorescontroller;
use App\Http\Controllers\Admin\PortadasController;
use App\Http\Controllers\Categoriagenerales;
use App\Http\Controllers\Cliente\Clientecontroller;
use App\Http\Controllers\Frontend\FrontendController;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
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


Route::get('/',function () {
    return Redirect::route("login");
});


Route::get('/logout',function () {
    return Redirect::route("login");
});

// Route::get('/admin/adminlte',function(){
//     $usuarios = User::all();
//     return view('admin.usuarios.modelo',compact('usuarios'));
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["prefix" => "panelcliente","middleware" => "role:cliente"], function () {
    Route::get("/pedidos",[Clientecontroller::class,"index"])->name("panelcliente");
});

Route::group(["prefix" => "admin", "middleware" => "role:admin"], function () {
    Route::resource("/proveedores",ProveedoresController::class,["as" => "admin"]);    
    Route::resource("/usuarios",UsuariosController::class,["as" => "admin"]);
    Route::resource("/categorias",CategoriasController::class,["as" => "admin"]);
    Route::resource("/subcategorias",SubcategoriasController::class,["as" => "admin"]);
    Route::resource("/productos",ProductosController::class,["as" => "admin"]);
    Route::resource("/pedidos",PedidosController::class,["as" => "admin"]);
    Route::resource("/detalles",DetallesController::class,["as" => "admin"]);
    Route::resource("/portadas",PortadasController::class,["as" => "admin"]);
    Route::resource("/categoriasgenerales",CategoriasgeneralesController::class,["as" => "admin"]);
   
});


Route::group(["prefix" => "panelproveedor","middleware" => "role:proveedor"], function () {
    Route::resource("/pedidos",Panelproveedorescontroller::class,["as" => "panelproveedor"]);
});
 

Route::group(["namespace" => "frontend"], function () {

    Route::get('/frontend',[FrontendController::class,"index"])->name('frontend');
    Route::get('/frontend/proveedoresporcategoria/{categoria}',[FrontendController::class,"proveedoresporcategoria"]);

    Route::get('/frontend/categoriasgenerales',[FrontendController::class,"categoriasgenerales"])->name('frontendcategoriasgenerales');

    Route::get('/frontend/productos/',[FrontendController::class,"indexProductos"])->name('frontend.indexProductos');
    Route::get('/frontend/productos/{proveedor_id}',[FrontendController::class,"productos"])->name('frontend.productos');
    Route::get('/frontend/agregaritem/{proveedor_id}',[FrontendController::class,"agregaritem"])->name('frontend.agregaritem');
    Route::get('/frontend/borraritem/{item}',[FrontendController::class,"borraritem"])->name('frontend.borraritem');
    Route::get('/frontend/pedidodetalle/{item}',[FrontendController::class,"pedidodetalle"])->name('frontend.pedidodetalle');
    Route::get('/frontend/procesar/',[FrontendController::class,"procesar"])->name('frontend.procesar');
    Route::get('/frontend/vaciar/',[FrontendController::class,"vaciar"])->name('frontend.vaciar');
    Route::get('/frontend/carrito/',[FrontendController::class,"carrito"])->name('frontend.carrito');
    Route::get('/frontend/historial/',[FrontendController::class,"historial"])->name('frontend.historial');
    Route::get('/frontend/historialdetalle/{id}',[FrontendController::class,"historialdetalle"])->name('frontend.historialdetalle');
});


