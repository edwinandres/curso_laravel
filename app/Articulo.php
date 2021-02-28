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

    public function cliente(){
        /**
         * 1.Clase a la que conecta 
         * 2.Foreignkey
         * 3.ownerkey 
         */
        return $this->belongsTo('App\Cliente','cliente_id', 'id');
    }
}
