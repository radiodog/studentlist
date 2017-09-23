<?php

error_reporting(-1);
mb_internal_encoding('utf-8');

require __DIR__.'/../vendor/autoload.php';
//Запускаем роутер 
$router = new Student\Classes\Router($_SERVER);
