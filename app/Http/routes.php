<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    // rutas de logueo
    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login');
    Route::get('logout', 'LoginController@logout');

    // ruta principal
    Route::group(['middleware' => ['autenticacion']], function() {
        Route::get('/', function () {
            return view('main');
        });

        // registrar la llegada de un oficio externo
        Route::get('registrar', 'Documentos\DocumentosController@capturar');
        Route::post('registrar', 'Documentos\DocumentosController@registrar');

        // ver oficios
        Route::get('oficios-recibidos', 'Documentos\DocumentosController@index');
        // turnar oficios
        Route::post('oficios-recibidos/turnar', 'Documentos\DocumentosController@turnar');
    });
});
