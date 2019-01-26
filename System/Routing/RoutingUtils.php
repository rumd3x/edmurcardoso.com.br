<?php

namespace EasyRest\System\Routing;

use EasyRest\System\Core;
use Tightenco\Collect\Support\Collection;

trait RoutingUtils
{
    /**
     * @param string $string
     * @return boolean
     */
    protected function isStringRouteVar(string $string)
    {
        return substr($string, -1, 1) === ':' && substr($string, 0, 1) === ':';
    }

    /**
     * @param Collection $params
     * @param Collection $values
     * @return Collection
     */
    protected function sortValues(Collection $params, Collection $values)
    {
        $result = collect([]);
        $matches = collect([]);
        foreach ($params as $key => $parameter) {
            $value = $values->get($parameter->name);
            $result->put($key, $value);
            if (!is_null($value)) {
                $matches->push($parameter->name);
            }
        }
        foreach ($result as $key => $value) {
            if (!is_null($value)) {
                continue;
            }

            foreach ($values as $parameter => $content) {
                if ($matches->contains($parameter)) {
                    continue;
                }
                $result->put($key, $content);
                $matches->push($parameter);
                break;
            }
        }
        return $result;
    }

    /**
     * @SuppressWarnings(PHPMD.StaticAccess)
     * Gets instance of the controller
     *
     * @param string $controllerName
     * @return mixed
     */
    protected function getController(string $controllerName)
    {
        $injector = Core::getInjector();

        if (class_exists($controllerName)) {
            return $injector->inject($controllerName);
        }

        if (class_exists("EasyRest\App\Controllers\\$controllerName")) {
            $controllerName = "EasyRest\App\Controllers\\$controllerName";
            return $injector->inject($controllerName);
        }

        return null;
    }
}
