<?php

return [
	'DB_ENGINE' => 'mysql',
	'DB_HOST' => 'localhost',
	'DB_NAME' => 'molly',
	'DB_USER' => 'admin',
	'DB_PASS' => '',
	'DB_CHARSET' => 'utf8',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ],
];