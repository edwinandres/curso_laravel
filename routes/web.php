<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Articulo;
use App\Cliente;
use Facade\FlareClient\Http\Client;

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
    $resultados = DB::select("SELECT * FROM articulos WHERE ID=?",[4]);
    foreach($resultados as $articulo){
        return $articulo->nombre_articulo;
    }
});

Route::get('/actualizar', function(){
    DB::update("UPDATE articulos SET seccion='Decoracion' WHERE id=?",[2]);
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


Route::get('/read2', function(){
    //$articulos = Articulo::where('observaciones','ganga')->take(1)->get();
    $articulos = Articulo::min('precio');
    return $articulos;
});


Route::get('/insertarDatos', function(){

    //se instancia el modelo
   $articulos = new Articulo;
   //se agregan los atributos
   $articulos->nombre_articulo = "pantalones";
   $articulos->precio = 343.235432;
   $articulos->pais_origen = "India";
   $articulos->seccion = "Ropa";
   $articulos->observaciones = "Ropa de hombre";

   //se invoca el metodo save
   $articulos->save();

});

Route::get('/actualizarDatos', function(){

    //se instancia el modelo
   $articulos = Articulo::find(8);
   //se agregan los atributos
   $articulos->nombre_articulo = "Pantalones de moda";
   $articulos->precio = 343.235432;
   $articulos->pais_origen = "India";
   $articulos->seccion = "Ropa";
   $articulos->observaciones = "Ropa de hombre";

   //se invoca el metodo save
   $articulos->save();

});

Route::get('/read3', function () {
    $articulos = Articulo::where('pais_origen','china')->get();
    return $articulos;
});


//actualizar varios registros a la vez

Route::get('actualizarVarios', function () {
    //en el where va el criterio y el valor actual
    //en el update va el criterio y el valor a actualizar(dentro de un array asociativo)
    Articulo::where('seccion','ceramica')->update(['seccion'=>'menaje']);
    //podemos usar tantos where como queramos
    Articulo::where('seccion','menaje')->where('pais_origen','Japon')->update(['precio'=>1000]);
});

Route::get('/borrar', function () {
    //para eliminar datos tambien podemos usar tantos where como queramos
    Articulo::where('id',6)->delete();
    Articulo::where('seccion','decoracion')->delete();
});

Route::get('/insertarVarios', function () {
    Articulo::create(['nombre_articulo'=>'gorra','pais_origen'=>'Mexico','precio'=>'700','seccion'=>'ropa','observaciones'=>'Ninguna']);
});

Route::get('/softdelete', function () {
    Articulo::find(4)->delete();
});

//para leer articulos borrados
Route::get('/leersoft', function () {
    $articulos = Articulo::withTrashed()->where('id',4)->get();
    return $articulos;
});

//RELACIONES UNO A UNO
Route::get('/cliente/{id}/articulo', function ($id) {
    return Cliente::find($id)->articulo;
});

Route::get('/articulo/{id}/cliente', function ($id) {
    return Articulo::find($id)->cliente->nombre;
});

//RELACIONES UNO A MUCHOS
Route::get('/cliente/{id}/articulos', function ($id) {
    return Cliente::find($id)->articulos;
});


//RELACION DE MUCHOS A MUCHOS

Route::get('/cliente/{id}/perfil', function ($id) {
    //$perfiles = Cliente::find($id)->perfiles;
    $cliente = Cliente::find($id);
    foreach($cliente->perfiles as $perfil){
        echo $perfil->nombre.'<br>';
    }
});

//RELACIONES POLIMORFICAS 

Route::get('/calificaciones', function () {
    $cliente = Cliente::find(1);
    foreach($cliente->calificaciones as $calificacion){
        echo $calificacion->calificacion;
    }
});


Route::get('/calificaciones2', function () {
    $articulo = Articulo::find(5);
    foreach($articulo->calificaciones as $calificacion){
        echo $calificacion->calificacion;
    }
});