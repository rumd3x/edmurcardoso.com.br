<?php

namespace EasyRest\System\Routing;

use ReflectionFunction;
use Tightenco\Collect\Support\Collection;

class ClosureCaller extends RouteCaller implements RouteCallerInterface
{
    /**
     * @param Collection $values
     * @return mixed
     */
    public function call(Collection $values)
    {
        $reflection = new ReflectionFunction($this->route->getAction());
        $parameters = collect($reflection->getParameters());
        return call_user_func_array($this->route->getAction(), $this->sortValues($parameters, $values)->all());
    }
}
