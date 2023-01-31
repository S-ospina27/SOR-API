<?php

require_once(__DIR__ . "/../vendor/autoload.php");

// inicializar .env
(Dotenv\Dotenv::createImmutable(__DIR__ . "/../"))->load();

// encabezados
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json");
date_default_timezone_set("America/bogota");
// constantes
define('env', (object) $_ENV);
define('request', LionRequest\Request::capture());
define('response',LionRequest\Response::getInstance());

// inicializar base de datos
use LionSQL\Drivers\MySQL as DB;

DB::init([
	'type' => env->DB_TYPE,
	'port' => env->DB_PORT,
	'host' => env->DB_HOST,
	'dbname' => env->DB_NAME,
	'user' => env->DB_USER,
	'password' => env->DB_PASS
]);

// rutas
LionRoute\Route::init();
include_once("../routes/web.php");
LionRoute\Route::dispatch();