<?php

/**
 *namespace se usa para no crear conflictos con otros archivos que se creen
 *con nombres similares
 * un namespace es como una carpeta donde se crean clases , funciones y demas
 */
namespace App\Http\Controllers;

//use es lo mismo que import
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
