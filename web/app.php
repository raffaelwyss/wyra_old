<?php

namespace Rawy;

use Wyra\Kernel\Kernel;

error_reporting(-1);

$loader = require __DIR__.'/../vendor/autoload.php';

$kernel = new Kernel();
$kernel->start();