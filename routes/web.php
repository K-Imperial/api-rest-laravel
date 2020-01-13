<?php

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
// Cargando clases
use App\Http\Middleware\ApiAuthMiddleware;

//RUTAS DE PRUEBAS
Route::get('welcome', function () {
    return view('welcome');
});

Route::get('/', function () {
    return "<h1>Hola mundo en Laravel</h1>";
});

Route::get('/pruebas/{nombre?}', function($nombre = null){
    $texto = '<h2>Texto desde una ruta</h2>';
    $texto .= 'Nombre: '.$nombre;
    return view('pruebas', array(
        'texto' => $texto
    ));
});

Route::get('/animales', 'PruebaController@index');
Route::get('/test-orm', 'PruebaController@testOrm');

//RUTAS DEL API

    /* Metodos HTTP comunes
    - GET: Conseguir datos o recursos
    - POST: Guardar datos, recursos o hacer logica desde un formulario
    - PUT: Actualizar recursos o datos
    - DELETE: Eliminar datos o recursos */

    //Rutas de pruebas
    /* Route::get('/usuario/pruebas', 'UserController@pruebas');
    Route::get('/categoria/pruebas', 'CategoryController@pruebas');
    Route::get('/entrada/pruebas', 'PostController@pruebas'); */
    
    //Rutas del controlador de usuarios
    Route::post('/api/register', 'UserController@register');
    Route::post('/api/login', 'UserController@login');
    Route::put('/api/user/update', 'UserController@update');
    Route::post('/api/user/upload', 'UserController@upload')->middleware(ApiAuthMiddleware::class);
    Route::get('/api/user/avatar/{filename}', 'UserController@getImage');
    Route::get('/api/user/detail/{id}', 'UserController@detail');

    // Rutas del controlador de categorias
    Route::resource('/api/category', 'CategoryController');
    
    // Rutas del controlador de categorias
    Route::resource('/api/post', 'PostController');
    Route::post('/api/post/upload', 'PostController@upload');
    Route::get('/api/post/image/{filename}', 'PostController@getImage');
    Route::get('/api/post/category/{id}', 'PostController@getPostsByCategory');
    Route::get('/api/post/user/{id}', 'PostController@getPostsByUser');
    
