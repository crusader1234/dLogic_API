<?php

include_once '../controllers/customerController.php';

use includes\Classname as Another;


$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode( '/', $uri);

// all of our endpoints start with /person
// everything else results in a 404 Not Found
if ($uri[3] !== 'customers') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

// the user id is, of course, optional and must be a number:
$userId = null;
if (isset($_GET['customerid'])) { 
    $userId = (int) $_GET['customerid'];
}

$requestMethod = $_SERVER["REQUEST_METHOD"];

// pass the request method and user ID to the PersonController and process the HTTP request:
$controller = new customerController( $requestMethod, $userId);
$controller->processRequest();