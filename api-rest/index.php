<?php 
/**
 * API REST base en PHP & PostgreSQL
 *
 * Este proyecto es una base para desarrollar API REST para la integracion entre proyectos y sistemas.
 * utilizando PHP 5.3 y PostgreSQL
 *
 * Desarrollo por: Alexander L. Lima & <3 
 *
 * Contacto: alexander.lima@detektor.com.gt
 *
 * Mas proyectos: https://github.com/alimadetektorgt/
 *
 * Los programadores Somos humanos, No máquinas..
*/


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');
header('Content-Type: text/html; charset=UTF-8');

/**
* Incluye las clases de la configuracion
*/
foreach (glob("config/*.php") as $filename) {
    include_once($filename);
}

/**
* Incluye las clases de la API
*/
foreach (glob("class/*.php") as $filename) {
    include_once($filename);
}

/**
* Inicia una variable para acceder a las clases
*/
$token    = new Token();

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
    	/**
    	* Metodo para obtener un token
    	*/
        if (isset($_GET['petition']) and $_GET['petition'] == 'getToken') {
        	print json_encode($token->getToken($_GET['token-id']));
        }

    	/**
    	* Metodo para administrar un token
    	*/
        if (isset($_GET['petition']) and $_GET['petition'] == 'adminToken') {
        	print json_encode($token->adminToken($_GET['token-id']));
        }

        /**
    	* Metodo para eliminar un token
    	*/
        if (isset($_GET['petition']) and $_GET['petition'] == 'deleteToken') {
        	print json_encode($token->deleteToken($_GET['token-id']));
        }
        break;
    default:
        print json_encode(array('error'=>'metodo no soportado'));
        break;
}
?>