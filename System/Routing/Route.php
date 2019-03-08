<?php
namespace EasyRest\System\Routing;

use EasyRest\System\Core;
use Tightenco\Collect\Support\Collection;

final class Route
{
    const GET = "GET";
    const POST = "POST";
    const PUT = "PUT";
    const DELETE = "DELETE";
    const HEAD = "HEAD";

    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    /**
     * @var mixed
     */
    private $action;

    /**
     * @var Collection
     */
    private $middlewares;

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     *
     * @param string $method
     * @param string $uri
     * @param mixed $action
     * @param array $middlewares
     */
    public function __construct(string $method, string $uri, $action, array $middlewares = [])
    {
        $this->uri = '/'.trim($uri, '/');
        $this->method = $method;
        $this->action = $action;
        $this->middlewares = collect($middlewares);

        $injector = Core::getInjector();
        $router = $injector->inject('Routing\Router');
        $router->addRoute($this);
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri()
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    private function addMiddleware($middleware)
    {
        $this->middlewares->push($middleware);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }
}
