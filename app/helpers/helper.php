<?php
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