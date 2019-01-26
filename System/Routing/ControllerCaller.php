<?php

namespace EasyRest\System\Routing;

use ReflectionMethod;
use Tightenco\Collect\Support\Collection;
use EasyRest\System\Exceptions\InvalidRouteActionException;

class ControllerCaller extends RouteCaller implements RouteCallerInterface
{
    /**
     * @var Collection
     */
    protected $actions;

    /**
     * @param Collection $values
     * @return mixed
     */
    public function call(Collection $values)
    {
        if (!$controller = $this->getController($this->actions->get('controller'))) {
            $message = sprintf('Could not find controller %s', $this->actions->get('controller'));
            throw new InvalidRouteActionException($message, $this->route);
        }

        if (!method_exists($controller, $this->actions->get('method'))) {
            $message = sprintf('Method %s not found on controller %s', $this->actions->get('method'), $this->actions->get('controller'));
            throw new InvalidRouteActionException($message, $this->route);
        }

        $reflection = new ReflectionMethod($controller, $this->actions->get('method'));
        $parameters = collect($reflection->getParameters());
        return $reflection->invokeArgs($controller, $this->sortValues($parameters, $values)->all());
    }

    /**
     * @param Collection $actions
     * @return self
     */
    public function setActions(Collection $actions)
    {
        $this->actions = $actions;
        return $this;
    }
}
