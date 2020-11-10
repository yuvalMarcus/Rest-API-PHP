<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


require_once 'model/File.php';
require_once 'controller/Router.php';
require_once 'controller/XssClean.php';

$router = new Router();

$router->post('quotes', function ($response) {

    $xssClean = new XssClean();

    $file = new File('quotes');

    $content = !empty($_POST['quotes']) ? $_POST['quotes'] : '';

    $content = $xssClean->clean_input($content);

    $file->write($content);

    $response->setSuccess(true);
    $response->setHttpStatusCode(200);
    $response->addMessage("quotes save");
    $response->setData($content);

    $response->send();
});

$router->end(function ($response) {

    $response->setSuccess(false);
    $response->setHttpStatusCode(404);
    $response->addMessage("not found");
    $response->setData([]);

    $response->send();
});
