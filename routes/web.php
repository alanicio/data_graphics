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

//Probar y ver diesño de layout general
Route::get('/principal',function(){
	return view('layouts.general');
});

//blueprint con estructura de graficas con selector javascript
Route::get('/graficas',function(){
	return view('blueprints.general_graphics');
});


//blueprint de grafica de barras
Route::get('/barras',function(){
	return view('blueprints.barras');
});

//blueprint de grafica de linea
Route::get('/linea',function(){
	return view('blueprints.line');
});

Route::get('example','ExampleController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
