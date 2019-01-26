<?php

namespace EasyRest\System\Routing;

use Tightenco\Collect\Support\Collection;

interface RouteCallerInterface
{
    /**
     * @param Route $route
     */
    public function __construct(Route $route);

    /**
     * @param Collection $values
     * @return mixed
     */
    public function call(Collection $values);
}
