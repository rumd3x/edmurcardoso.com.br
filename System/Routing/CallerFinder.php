<?php

namespace EasyRest\System\Routing;

use Closure;
use Tightenco\Collect\Support\Collection;
use EasyRest\System\Exceptions\InvalidRouteActionException;

final class CallerFinder
{
    /**
     * @var Route
     */
    private $route;

    public function __construct(Route $route)
    {
        $this->route = $route;
    }

    /**
     * @return RouteCallerInterface
     */
    public function getCaller()
    {
        if ($this->isClosure()) {
            return new ClosureCaller($this->route);
        }

        $actions = $this->validateActionString();
        return (new ControllerCaller($this->route))->setActions($actions);
    }

    /**
     * @return boolean
     */
    private function isClosure()
    {
        return ($this->route->getAction() instanceof Closure);
    }

    /**
     * @return Collection
     * @throws InvalidRouteActionException
     */
    private function validateActionString()
    {
        if (!is_string($this->route->getAction())) {
            throw new InvalidRouteActionException('Not a valid string or closure defined as action', $this->route);
        }

        $actionArray = array_filter(explode('@', $this->route->getAction()));
        if (trim($this->route->getAction()) === '' || count($actionArray) !== 2) {
            throw new InvalidRouteActionException('Not a valid action string', $this->route);
        }

        return collect(['controller' => $actionArray[0], 'method' => $actionArray[1]]);
    }
}
