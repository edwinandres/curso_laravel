<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Articulo extends Model
{
    use SoftDeletes;

    protected $dates = ['$deleted_at'];
    
    //estos dos atributos solo hacen falta si no usamos las reglas de definicion de nombres de tabla y modelos
    protected $table="articulos";
    protected $primaryKey="id";

    //el protected fillable es para realizar asignacion masiva(para usar el metodo create)
    protected $fillable = [
        'nombre_articulo',
        'precio',
        'pais_origen',
        'seccion',
        'observaciones'
    ];
}
