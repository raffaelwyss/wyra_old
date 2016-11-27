<?php


namespace Wyra\Plugin\Base\Controller;

use Wyra\Kernel\MVC\Controller;

class Home extends Controller
{

    public function __construct(array $args)
    {
        parent::__construct($args);
        $this->addArgument('template', 'home.tpl');
    }

    public function getData()
    {
        return array('abc');
    }

}