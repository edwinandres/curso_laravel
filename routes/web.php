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
Route::get('/', function () { return "Hemos llegado a la página inicial";});
Route::get('/nosotros', function () { return "Acerca de nosotros";});
Route::get('/que hacemos', function () { return "Lo que nosotros hacemos";});
Route::get('/galeria', function () { return "Galeria de imagenes";});
Route::get('/enlaces', function () { return "Enlaces externos";});


//relacionamos el parametro id de la url con una variable de php
Route::get('/post/{id}/{nombre}', 
    function ($id,$nombre) { 
        return "Este es el post No:".$id." y pertenece al usuario: ".$nombre;
    })->where('nombre','[a-zA-Z]+');//aqui le estamos diciendo que solo acepta letras mayusculas y minusculas
