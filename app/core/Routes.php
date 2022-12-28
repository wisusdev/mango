<?php

namespace App\core;

class Routes
{
    private string|array $uri;

    public function __construct() {
        $this->dispatch();
    }

    /*
    * Metodo para filtrar y descomponer los elemtos de la URL y URI
    * */
    private function filter_url(): void
    {

        if (isset($_SERVER['REQUEST_URI'])){
            $this->uri = $_SERVER['REQUEST_URI'];
            $this->uri = ltrim($this->uri, '/');
            $this->uri = filter_var($this->uri, FILTER_SANITIZE_URL);
            $this->uri = explode('/', strtolower($this->uri));

        }
    }

    /*
     * Metodo para ejecutar y cargar automatica el controlador solicitado por el usuario
     * Llamado al metodo y pasar parametros
     * */
    private function dispatch(): void
    {
        // Filtrar la URL y separar la URI
        $this->filter_url();

        // Obtenemos el Controlador ($this->>uri[0])
        if (!empty($this->uri[0])){
            $current_controller = ucfirst($this->uri[0]);
            unset($this->uri[0]);
        } else {
            $current_controller = 'Home';
        }

        // Ejecucion del controlador
        // Comprobamos si existe una clase con el controlador solicitado
        $controller = 'App\http\controllers\\' . $current_controller.'Controller';

        if (!class_exists($controller)){
            http_response_code(404);
            die(sprintf('ocurrió un error, no encontramos el controlador %s :|', $controller));
        }

        // Ejecutar metodo solicitado
        if (isset($this->uri[1])) {
            $method = str_replace('-', '_', $this->uri[1]);

            //Validamos si existe el metodo en el controlador
            if(!method_exists($controller, $method)) {
                http_response_code(404);
                include('Sorry, pero ocurrio un error compa :|');
                die();
            } else {
                $current_method = $method;
            }

            unset($this->uri[1]);
        } else {
            $current_method = 'index';
        }

        // Ejecutando controlador y metodo segun peticion
        $controller = new $controller;

        // Obteniendo parametros de nuestra URI
        $params = array_values(empty($this->uri) ? [] : $this->uri);

        // Llamada al metodo que solicita el usuario
        if (empty($params)){
            call_user_func([$controller, $current_method]);
        } else {
            call_user_func_array([$controller, $current_method], $params);
        }
    }
}