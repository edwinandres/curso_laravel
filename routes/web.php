<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Articulo;



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
//Route::get('/', function () { return view('welcome');});

// Route::get('/nosotros', function () { return "Acerca de nosotros";});
// Route::get('/que hacemos', function () { return "Lo que nosotros hacemos";});
// Route::get('/galeria', function () { return "Galeria de imagenes";});
// Route::get('/enlaces', function () { return "Enlaces externos";});


//relacionamos el parametro id de la url con una variable de php
/*
Route::get('/post/{id}/{nombre}', 
    function ($id,$nombre) { 
        return "Este es el post No:".$id." y pertenece al usuario: ".$nombre;
    })->where('nombre','[a-zA-Z]+');//aqui le estamos diciendo que solo acepta letras mayusculas y minusculas
*/

//enlazamos una ruta a un controlador
Route::get('/inicio/{id}','Ejemplo3Controller@index' );

//Rutas para nuestra aplicacion
/*
Route::get('/','PaginasController@inicio');
Route::get('/inicio','PaginasController@inicio');
Route::get('/quienessomos','PaginasController@quienesSomos');
Route::get('/dondeEstamos','PaginasController@dondeEstamos');
Route::get('/foro','PaginasController@foro');
*/
//utilizando el metodo resource se crean automaticamente las rutas de crud para posts
Route::resource('posts', 'Ejemplo3Controller');

Route::get('/','MiController@index');
Route::get('/articulos', 'MiController@store');
Route::get('/mostrar/{id}', 'MiController@show');
Route::get('/crear', 'MiController@create');
Route::get('/contacto','MiController@contactar');
Route::get('/galeria','MiController@galeria');

//OPERACIONES CON RAW SQL
Route::get('/insertar', function(){ 
    DB::insert("INSERT INTO articulos (NOMBRE_ARTICULO,PRECIO,PAIS_ORIGEN,SECCION,OBSERVACIONES)
     VALUES (?,?,?,?,?)", ["Jarron", 15.2, "Japon", "ceramica", "ganga"]);
});

Route::get('/leer', function(){
    $resultados = DB::select("SELECT * FROM articulos WHERE ID=?",[1]);
    foreach($resultados as $articulo){
        return $articulo->nombre_articulo;
    }
});

Route::get('/actualizar', function(){
    DB::update("UPDATE articulos SET seccion='Decoracion' WHERE id=?",[1]);
});

Route::get('/borrar', function(){
    DB::delete("DELETE FROM articulos WHERE id=?",[1]);
});

//CONSULTAS USANDO ELOQUENT
Route::get('/read', function(){
    $articulos = Articulo::all();
    foreach($articulos as $articulo){
        echo $articulo->nombre_articulo.' '.$articulo->precio.'<br>';
    }
});