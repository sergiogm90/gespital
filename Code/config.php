<?php
// General
define('VISTA_PORDEFECTO', 'index');

// Directorios
define('PAGE_PATH', dirname(__FILE__));
define('VISTAS_PATH', PAGE_PATH.'/mvc/vista/');

// MYSQL
define('MYSQL_CONFIG', serialize([
    'database_type' => 'mysql',
    'database_name' => 'mispruebas',
    'server' => 'localhost',
    'username' => 'root',
    'password' => '',
    'charset' => 'utf8',
    'port' => 3306,
    'option' => [PDO::ATTR_CASE => PDO::CASE_NATURAL]]));
