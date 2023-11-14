<?php
// Trabajando variables de entorno
$env = parse_ini_file(".env");
//print_r($env);

foreach ($env as $llave => $value) {
    $_ENV[$llave] = $value;
}

// Configurar cabezeras para el servicio
// Configurando el tipo de contenido para las respuestas
header("Content-Type: application/json");

// Configurar el acceso para cualquier origen y métodos permitidos
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, PATCH, DELETE, OPTIONS");
header("Allow: GET, POST, PUT, PATCH, DELETE, OPTIONS");

//  Incluyendo todas las constantes que usaremos
include_once("./constantes/constantes.php");
/*
    *
    *   El objeto _SERVER de PHP contiene la información de la petición, tal como la URL solicitada
    *
    */
$request_uri = $_SERVER['REQUEST_URI'];

// Método solicitado:
$request_method = $_SERVER['REQUEST_METHOD'];


// Obteniendo la información completa de la URL
$url_components = parse_url($request_uri);
$query_params = array();

$path_url = $url_components['path'];
$path_url = ltrim($path_url, '/');

if (isset($url_components['query'])) {
    parse_str($url_components['query'], $query_params);
}


$path_components = explode('/',  $path_url);

$api_check_index = 1;
$version_check_index = $api_check_index + 1;
$path_index = $version_check_index + 1;

// echo json_encode($path_components);

if (
    !isset($path_components[$api_check_index])
    ||
    $path_components[$api_check_index] != "api"
) {
    //Notificar de no existencia de url
    header(HTTP_CODE_400);
    // Romper ejecución de php
    exit();
}

if (!isset($path_components[$version_check_index])) {
    // Notifico de mala petición
    header(HTTP_CODE_400);
    // Rompemos ejecución del resto de código
    exit();
}

switch ($path_components[$version_check_index]) {
    case 'v-1':
        require_once("./v-1/app.controller.php");
        break;

    default:
        header(HTTP_CODE_400);
        exit();
}
