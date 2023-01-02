<?php

namespace App\core;

use PDO;
use PDOException;

class Database {
    public function __construct() {
        try {
            $config = config('database');
            $dsn = 'mysql:host=' . $config['db']['host'] . ';dbname=' . $config['db']['name'];
            return new PDO($dsn, $config['db']['user'], $config['db']['pass'], $config['db']['options']);
        } catch(PDOException $error) {
            die($error->getMessage());
        }
    }
}