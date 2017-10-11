<?php

error_reporting(-1);
mb_internal_encoding('utf-8');

require __DIR__.'/../vendor/autoload.php';

$services = [];
$services['UserDataGateway'] = new Student\Models\UserDataGateway(Student\Helpers\Utils::createPDO());
$services['Validator'] = new Student\Helpers\Validator($services); 
$services['View'] = new Student\View\View($services);

$router = new Student\Routers\Router();

$controller = $router->getController($services);
$actionName = $router->getAction();

$controller->$actionName();

