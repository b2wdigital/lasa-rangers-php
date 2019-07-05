<?php

error_reporting(E_ALL);
ini_set("display_errors", 1); 

$config['allow_double_session'] = false;

$db = [
    "mysql" => 
    [
        "type" => 'mysql',
        "host" => 'localhost',
        "user" => 'root',
        "password" => 'root',
        "dbname" => 'test',
        "charset" => 'utf8',
        "options" => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
    ],
    "sqlite" =>
    [
        "type" => 'sqlite',
        "host" => '/var/www/tsutsui/',
        "user" => '',
        "password" => '',
        "dbname" => 'bacondb.db',
        "options" => [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]
    ]
];