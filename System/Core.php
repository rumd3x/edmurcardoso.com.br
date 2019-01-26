<?php
namespace EasyRest\System;

use Throwable;
use EasyRest\System\Response\TextResponse;

final class Core
{
    /**
     * @var Environment
     */
    public $env;

    /**
     * @var TimeTracker
     */
    public $timeTracker;

    /**
     * @var Injector
     */
    public static $injector;

    /**
     * @var Request
     */
    public $request;

    /**
     * @var Router
     */
    public $router;

    /**
     * @var Kernel
     */
    public $kernel;

    /**
     * @var boolean
     */
    private $showErrors = false;

    public function __construct()
    {
        self::$injector = new Injector();
    }

    /**
     * Configures the application for running it
     *
     * @return self
     */
    public function prepare()
    {
        $this->timeTracker = $this->getInjector()->inject('TimeTracker');
        $this->env = $this->getInjector()->inject('Environment');
        $this->env->parseFile(__DIR__.'/../environment.json');
        $this->toggleShowErrors();
        return $this;
    }

    /**
     * @return void
     */
    private function toggleShowErrors()
    {
        if ($this->env->get('server') !== 'production') {
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);
            $this->showErrors = true;
        }
    }

    /**
     * @return Injector
     */
    public static function getInjector()
    {
        return self::$injector;
    }

    /**
     * Runs the application
     *
     * @return void
     */
    public function start()
    {
        try {
            $this->kernel = $this->getInjector()->inject('Kernel');
            $this->request = $this->getInjector()->inject('Request');
            $this->router = $this->getInjector()->inject('Routing\Router');
            $this->router->handle($this->request);
        } catch (Throwable $th) {
            if ($this->showErrors) {
                (new TextResponse($th->getMessage()))->withStatus($th->getCode());
                throw $th;
            }
        }
    }
}
