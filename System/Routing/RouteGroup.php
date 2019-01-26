<?php

namespace EasyRest\System\Routing;

use Exception;
use Tightenco\Collect\Support\Collection;

final class RouteGroup
{
    public function __construct(string $baseUri, array $middlewares, array $routes = null)
    {
        $baseUri = '/'.trim($baseUri, '/');

        if (is_null($routes)) {
            $routes = $middlewares;
            $middlewares = [];
        }

        foreach ($routes as $key => $route) {
            if (
                !isset($route[0])
                || !isset($route[1])
                || !isset($route[2])
                || !is_string($route[0])
                || !is_string($route[1])
            ) {
                throw new Exception("Invalid route inside Route Group");
            }
            new Route($route[0], $baseUri.'/'.trim($route[1], '/'), $route[2], $middlewares);
        }
    }
}
