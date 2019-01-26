<?php

namespace EasyRest\System\Routing;

use Closure;
use EasyRest\System\Request;
use EasyRest\System\Exceptions\InvalidClassException;

final class MiddlewareFactory
{
    /**
     * @var string
     */
    private $middleware;

    public function __construct(string $middlware)
    {
        $this->middleware = $middlware;
    }

    /**
     * Returns the instanciated middleware
     *
     * @return MiddlewareInterface
     * @throws InvalidClassException
     */
    public function getMiddleware()
    {
        try {
            if (class_exists('EasyRest\App\Middlewares\\'.$this->middleware)) {
                $middleware = 'EasyRest\App\Middlewares\\'.$this->middleware;
                return new $middleware;
            }

            return new $this->middleware;
        } catch (\Throwable $th) {
            throw new InvalidClassException("Middleware not found", $this->middleware, $th);
        }
    }
}
