<?php

/**
 *namespace se usa para no crear conflictos con otros archivos que se creen
 *con nombres similares
 * un namespace es como una carpeta donde se crean clases , funciones y demas
 */
namespace App\Http\Controllers;

class EjemploController extends Controller
{
    public function inicio (){ 
      return "Estas en el inicio del sistema";
    }
}
