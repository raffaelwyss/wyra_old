<?php

namespace Rawy;

use Wyra\Kernel\Kernel;

$loader = require __DIR__.'/../vendor/autoload.php';

$kernel = new Kernel();
$kernel->start();