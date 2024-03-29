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

Route::get('/', function () {
    return view('welcome');
});

//Presentacion de datos
Route::get('/graficas','Datos\GraficaController@index');
Route::get('formulario/{id}','Datos\GraficaController@formulario');
Route::get('calibracion/{tipo}','Datos\GraficaController@calibracion');
Route::post('graficar','Datos\GraficaController@graficar');
	//filtros
Route::get('verificentros/{tipo}','Datos\GraficaController@verificentros');
Route::get('lineas/{tipo}','Datos\GraficaController@lineas');
Route::post('filtrar','Datos\GraficaController@filtrar');


//Modulo de usuarios
Route::resource('usuarios','Sesion\UsuarioController');


//Probar y ver diesño de layout general
Route::get('/principal',function(){
	return view('layouts.general');
});




//blueprint login

Route::get('/inicio',function(){
	return view('blueprints.login');
});

//blueprint registro

Route::get('/registro',function(){
	return view('blueprints.registro');
});

Route::get('example','ExampleController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
