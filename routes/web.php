<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

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


Route::get('/',[HomeController::class, "index"] )->name("index");

Route::get("/verificarLogin",[HomeController::class,"verificarLogin"])->name("verificarLogin");

Route::get("/paginaPrincipal",[HomeController::class,"paginaPrincipal"])->name("paginaPrincipal")->middleware("auth");

Route::post("/deslogueo",[HomeController::class,"deslogueo"])->name("deslogueo")->middleware("auth");

Route::get("/formRegistrarUsuario",[UsuarioController::class,"formRegistrarUsuario"])->name("formRegistrarUsuario")->middleware("auth");

Route::get("/formRegistrarUsuario2",[UsuarioController::class,"formRegistrarUsuario2"])->name("formRegistrarUsuario2")->middleware("auth");


Route::post("/storeUsuario",[UsuarioController::class,"storeUsuario"])->name("storeUsuario")->middleware("auth");

Route::post("/storeUsuario2",[UsuarioController::class,"storeUsuario2"])->name("storeUsuario2")->middleware("auth");


Route::delete("/eliminarUsuario",[UsuarioController::class,"eliminarUsuario"])->name("eliminarUsuario")->middleware("auth");

Route::get("/actualizarUsuario",[UsuarioController::class,"actualizarUsuario"])->name("actualizarUsuario")->middleware("auth");

Route::get("/storeActualizarUsuario",[UsuarioController::class,"storeActualizarUsuario"])->name("storeActualizarUsuario")->middleware("auth");

Route::get("/aplicarAbono",[UsuarioController::class,"aplicarAbono"])->name("aplicarAbono")->middleware("auth");

Route::post("/storeAbono",[UsuarioController::class,"storeAbono"])->name("storeAbono")->middleware("auth");

Route::get("/prestamoDeudaForm",[UsuarioController::class,"prestamoDeudaForm"])->name("prestamoDeudaForm")->middleware("auth");

Route::get("/storeActualizarUsuarioPrestamoDeuda",[UsuarioController::class,"storeActualizarUsuarioPrestamoDeuda"])->name("storeActualizarUsuarioPrestamoDeuda")->middleware("auth");

Route::delete("/eliminarAbono",[UsuarioController::class,"eliminarAbono"])->name("eliminarAbono")->middleware("auth");

Route::get("/tablaClientes",[UsuarioController::class,"tablaClientes"])->name("tablaClientes")->middleware("auth");
