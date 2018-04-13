<?php

header('Content-Type: application/json;charset=UTF-8');
header('Accept: application/json');
header("Access-Control-Allow-Origin: *");

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['SCRIPT_NAME'];
$query = [];
parse_str($_SERVER['QUERY_STRING'] ?? "", $query);
$content = json_decode( file_get_contents("php://input"), true );
$file = "." . $path . ".php";

if (!file_exists($file)) {
    header("HTTP/1.1 404 Not Found", true, 404);
    die;
}

$handle = include $file;

if ( !is_object($handle) ) {
    header("HTTP/1.1 500 Internal Server Error", true, 500);
    die;
}

if ( !(is_subclass_of($handle, "RestObject")) ) {
    header("HTTP/1.1 503 Service Unavailable", true, 503);
    die;
}

try {
    echo json_encode( $handle->$method($query, $content) );
} catch (Exception $e) {
    header("HTTP/1.1 500 Internal Server Error", true, 500);
    die;
}