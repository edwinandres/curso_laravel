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

//Route es una clase y get un metodo estatico
//el primer parametro es la url a donde quiero ir
//la funcion anonima dice lo que se va a ejecutar al introducir la url
Route::get('/home', function () {
    return view('welcome');
});
