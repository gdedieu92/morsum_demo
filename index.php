<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', __DIR__);

/* LOAD DATA */
require_once (ROOT . '/config/config.php');
require_once (ROOT . '/libs/Router.php');
require_once (ROOT . '/libs/Controller.php');
require_once (ROOT . '/libs/View.php');
require_once (ROOT . '/libs/Database.php');
require_once (ROOT . '/libs/Model.php');
require_once (ROOT . '/libs/Functions.php');
require_once (ROOT . '/libs/Data.php');

$router = new Router();

/* SANITIZE GET PARAMETER */
$urlSucia = filter_input(INPUT_GET, 'url');
$clearUrl = $router->clearUrl($urlSucia);

/* CONTROLLER REQUESTED */
$requestedController = $router->getController($clearUrl);

/* METHOD REQUESTED */
$requestedMethod = $router->getMethod($clearUrl);

/* GET PARAMETERS */
$parameters = $router->getParameters($clearUrl);
$controller = $router->loadController($requestedController, $requestedMethod);

/* START SESSION PHP */
session_start();

/* ROUTING IF POSSIBLE */
if ($controller) {
    $controller->view->setActiveController($requestedController);
    $controller->view->setActiveMethod($requestedMethod);
    if (method_exists($controller, $requestedMethod)) {
        if ($parameters) {
            $controller->{$requestedMethod}($parameters);
        } else {
            $controller->{$requestedMethod}();
        }
    } else {
        $controller->index();
    }
} else {
    echo $controller;
    redirect('error/notFound');
}






