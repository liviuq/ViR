<?php

require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

include_once "RestController.php";
include_once "../models/Authentication.php";

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri );

$requestMethod = $_SERVER["REQUEST_METHOD"];

$authController = new Authentication($requestMethod);

switch ($uri[2]) {
    case 'cats':

        $jwt = $authController-> checkJWTExistance();
        $authController -> validateJWT($jwt);


        $catId = null;
        if (isset($uri[3])) { $catId = (int) $uri[3]; }
        $controller = new RestController($requestMethod, $catId);
        $controller->processRequest();
        break;
    case 'auth':
        $authController->processRequest();
        break;
    default:
        header("HTTP/1.1 404 Not Found");
        exit();
}