<?php



require __DIR__ . "/../vendor/autoload.php";

use Framework\Router;
use Framework\Session;

Session::start();

require '../helpers.php';


// Instatiating the router

$router = new Router();



// get routes
$routes = require basePath('routes.php');


// get the current URI and httpMethod
$uri =  parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);


// Route the request
$router->route($uri);













