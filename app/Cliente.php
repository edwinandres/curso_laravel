<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    public function articulo(){
        //en el return va, el modelo con que relaciona, luego la llava foranea de la relacion
        //y luego la primary key de esta tabla(los ultimos dos no hacen falta si se definen
        //los nombres de acuerdo al reglamento de laravel)
        /**
         * 1. El modelo a relacionar
         * 2. La clave mia que va en la otra tabla (foreign key)
         * 3. la clave primaria mia, (local key)
         */
        return $this->hasOne('App\Articulo' ,'cliente_id', 'id');
    }

    public function articulos(){
        return $this->hasMany('App\Articulo', 'cliente_id', 'id');
    }

    public function perfiles(){
        /**
         * 1.Modelo a relacionar
         * 2.Nombre de la tabla pivot
         * 3.id de esta tabla dentro de pivot
         * 4.id de la tabla a relacionar dentro de pivot
         * Aunque si se siguen las recomendaciones de laravel, solo haria faltal el modelo
         */
        return $this->belongsToMany('App\Perfil', 'cliente_perfil', 'cliente_id', 'perfil_id' );
    }

    public function calificaciones(){
        /**
         * 1.Modelo de la tabla morph 
         * 2.La funcion de morph que se creo en ese modelo
         * 
         */
        return $this->morphMany('App\Calificacion','calificacion');
    }
}
