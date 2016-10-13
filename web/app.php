<?php

use WyRa\AppKernel;
use Symfony\Component\HttpFoundation\Request;

$loader = require __DIR__.'/../vendor/autoload.php';
require '../app/AppKernel.php';

$kernel = new AppKernel('prod', false);
$kernel->loadClassCache();

$kernel = new AppCache($kernel);

Request::enableHttpMethodParameterOverride();

$request = Request::createFromGlobals();
$response = $kernel->handle($request);
$response->send();

$kernel->terminate($request, $response);

echo 'Fertig mit dem Laden von WyRa';