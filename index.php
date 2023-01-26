<?php

require_once("./vendor/autoload.php");
header('Access-Control-Allow-Origin: *');
header("Content-Type: application/json; charset=UTF-8");
use SRC\Config\DB ;
use SRC\Helpers\Response;
use SRC\Helpers\Request;
USE SRC\Helpers\Helpers;
USE SRC\App\Controllers\HomeController;
DB::init(
	// "45.151.120.12", "u804519145_Prisma", "u804519145_Prisma", "2o5UxEQyU"
	"localhost", "carrito", "root", "santiago"
);

$request = (new Request())->capture();
$response = new Response();
// -------------------------------------------------------------------------------------------------
Helpers::init($request, $response);
Helpers::exists("type", "La ruta no existe [1]");

switch ($request->type) {

	case 'insertar':
	$Home= new HomeController($request,$response);
	$response->finish($Home->Insertar());
	break;

	case 'Buscar':
	$Home= new HomeController($request,$response);
	$response->finish($Home->Buscar());
	break;

	case 'mirar':
	$Home= new HomeController($request,$response);
	$response->finish($Home->mirar());
	break;
	default:
	$response->finish($response->error("La ruta no existe [2]"));
	break;
}