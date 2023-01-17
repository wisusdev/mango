<?php

use App\core\Csrf;
use App\core\Debug;

function to_object($array) {
    return json_decode(json_encode($array));
}

function now(): string
{
    return date('Y-m-d H:i:s');
}

function asset(string $file): string
{
    $domain = get_domain();
    return $domain . 'public/' . $file;
}


function get_domain(): string
{
    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
    $domainName = $_SERVER['HTTP_HOST'].'/';
    return $protocol . $domainName;
}

function include_file(string $view, array $data = []): void
{

    $viewPath = './resources/views/' . $view . '.php';

    // Convertir el array asociativo en un objeto
    $d = to_object($data); // $data es un array y $d es un objeto

    if (!is_file( $viewPath)){
        die(sprintf('No existe la vista %s en el directorio', $view));
    }

    require_once $viewPath;
}

function url(string $route): string
{
    return get_domain() . $route;
}

function config(string $conf): string | array
{
    $path = explode('.', strtolower($conf));

    $filePath = './config/' . trim($path[0]) . '.php';
    $fileConf = include $filePath;

    return search_config($fileConf, array_slice($path, 1));
}

function search_config(array $array, array $search): string | array
{
    search_in_array($array, $search, $results);
    return $results;
}

function search_in_array(array $array, array $search, &$results){
    foreach ($search as $valueSearch){
        if (array_key_exists($valueSearch, $array)){
            $results = $array[$valueSearch];

            if (is_array($results)){
                search_in_array($results, $search, $results);
            }

            return $results;
        }
    }
}

function dd($data) {
    Debug::var_dump($data);
}

function insert_inputs() {
    $output = '';

    if(isset($_POST['redirect_to'])){
        $location = $_POST['redirect_to'];
    } else if(isset($_GET['redirect_to'])){
        $location = $_GET['redirect_to'];
    } else {
        $location = get_domain();
    }

    $csrf = new Csrf();
    $csrf_token = $csrf->get_token();

    $output .= '<input type="hidden" name="redirect_to" value="'.$location.'">';
    $output .= '<input type="hidden" name="timecheck" value="'.time().'">';
    $output .= '<input type="hidden" name="csrf" value="'.$csrf_token.'">';
    $output .= '<input type="hidden" name="hook" value="jserp_hook">';
    $output .= '<input type="hidden" name="action" value="post">';
    return $output;
}