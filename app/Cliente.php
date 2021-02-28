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
}
