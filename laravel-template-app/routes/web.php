<?php

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EjemploController;

use App\Http\Controllers\LoginControllerAPI;
use App\Http\Controllers\BloquesEntrenamientoController;
use App\Http\Controllers\PlanesEntrenamientoController;
use App\Http\Controllers\SesionesEntrenamientoController;
use App\Http\Controllers\ResultadosEntrenamientoController;
use App\Http\Controllers\SesionesBloquesEntrenamientoController;

Route::get('/', function () {
  return view('login');
});
// web.php
Route::post('/login-test', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'Ruta POST funcionando'
    ]);
});


//RUTAS PARA LA AUTENTICACION
Route::post('/login', [LoginControllerAPI::class, 'comprobarCredenciales'])->name('login.comprobar');
Route::post('/logout', [LoginControllerAPI::class, 'cerrarSesion'])->name('logout.salirse');
Route::post('/register', [LoginControllerAPI::class, 'darseAlta'])->name('register.alta');

//RUTAS PARA CICLISTA
Route::post('/ciclistas', [CiclistaController::class, 'listarCiclistas'])->name('ciclistas.listar');
Route::post('/ciclista/historial', [CiclistaController::class, 'listarCiclistaID'])->name('ciclista.listar');


//RUTAS PARA LOS BLOQUES DE ENTRENAMIENTO
Route::get('/bloque', [BloquesEntrenamientoController::class, 'listarBloques'])->name('bloques.listar');
Route::post('/bloque/crear', [BloquesEntrenamientoController::class, 'crearBloque'])->name('bloque.crear');
Route::get('/bloque/{id}', [BloquesEntrenamientoController::class, 'listarBloqueID'])->name('bloque.listar');
Route::delete('/bloque/{id}/eliminar', [BloquesEntrenamientoController::class, 'eliminarBloque'])->name('bloque.eliminar');

//RUTAS PARA LOS PLANES DE ENTRENAMIENTO
Route::get('/plan', [PlanesEntrenamientoController::class, 'listarPlanes'])->name('planes.listar');
Route::post('/plan/crear', [PlanesEntrenamientoController::class, 'crearPlan'])->name('plan.crear');
Route::put('/plan/{id}', [PlanesEntrenamientoController::class, 'modificarPlan'])->name('plan.modificar');
Route::delete('/plan/{id}', [PlanesEntrenamientoController::class, 'eliminarPlan'])->name('plan.eliminar');

//RUTAS PARA SESIONES DE ENTRENAMIENTO
Route::get('/sesion', [SesionesEntrenamientoController::class, 'listarsesiones'])->name('sesiones.listar');
Route::post('/sesion/crear', [SesionesEntrenamientoController::class, 'crearsesion'])->name('sesion.crear');
Route::delete('/sesion/{id}', [SesionesEntrenamientoController::class, 'eliminarsesion'])->name('sesion.eliminar');
Route::get('/sesion/{id}', [SesionesEntrenamientoController::class, 'listarsesionID'])->name('sesion.listar');

//RUTAS PARA RESULTADOS DE ENTRENAMIENTO
Route::post('/resultado/crear', [ResultadosEntrenamientoController::class, 'crearResultado'])->name('resultado.crear');
Route::get('/resultado/{id}', [ResultadosEntrenamientoController::class, 'listarResultadoID'])->name('resultado.listar');

//RUTAS PARA SESIONES-PLANES ENTRENAMIENTO
Route::get('/sesionbloque', [SesionesBloquesEntrenamientoController::class, 'listarSesionesBloques'])->name('sesionbloque.listar');
Route::post('/sesionbloque/crear', [SesionesBloquesEntrenamientoController::class, 'crearSesionBloque'])->name('sesionbloque.crear');
Route::delete('/sesionbloque/{id}', [SesionesBloquesEntrenamientoController::class, 'borrarSesionBloque'])->name('sesionbloque.eliminar');

















Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
Route::get('/ejemplo', [EjemploController::class, 'index']);
Route::get('/api/articles', [ArticleController::class, 'listArticlesAPI'])->name('articles.listArticles');
Route::get('/api/articles/{id}', [ArticleController::class, 'listADetailArticleAPI'])->name('articles.listArticle');
Route::delete('/api/articles/{id}', [ArticleController::class, 'deleteArticleAPI'])->name('articles.deleteArticleAPI');

