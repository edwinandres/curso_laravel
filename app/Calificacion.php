<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Calificacion extends Model
{
    //
    public function calificacion(){
        return $this->morphTo();
    }
}
