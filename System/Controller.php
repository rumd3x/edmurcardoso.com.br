<?php
namespace EasyRest\System;

use EasyRest\System\Core;

abstract class Controller
{
    /**
     * @var Injector
     */
    protected $injector;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     */
    public function __construct()
    {
        $this->injector = Core::getInjector();
        $this->request = $this->injector->inject('Request');
    }
}
