<?php

namespace App\core;

class View
{
    public static function render($view, $data = []){

        $viewPath = './resources/views/' . $view . '.php';

        // Convertir el array asociativo en un objeto
        $d = to_object($data); // $data es un array y $d es un objeto

        if (!is_file( $viewPath)){
            die(sprintf('No existe la vista %s en el directorio', $view));
        }

        require_once $viewPath;
    }
}