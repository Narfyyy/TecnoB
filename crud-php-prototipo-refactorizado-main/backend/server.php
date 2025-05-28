<?php
/**
 * DEBUG MODE
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$url = $_SERVER['REQUEST_URL'];
$url = trim($url,'/');
$partes = explode($url,'/');

if (count($partes)<2 || $partes[0]!=='api'){
    http_response_code(400);
    echo "URL no valida";
    exit();
}

$modulo = $partes[1];
$archivo = ("routes/", $modulo, "Routes.php");

if file_exists($archivo){
    require_once($archivo);
}
else {
    http_response_code(400);
    echo "Modulo no encontrado ", $modulo;
}
?>