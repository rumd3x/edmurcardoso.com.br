<?php
namespace EasyRest\App;

use EasyRest\System\Exceptions\InvalidRouteException;

final class Kernel
{
    public function __construct()
    {
        $this->loadRoutes();
    }

    /**
     * @return void
     * @throws InvalidRouteException
     */
    private function loadRoutes()
    {
        try {
            foreach (glob(__DIR__.'/Routes/*') as $routeFile) {
                include_once $routeFile;
            }
        } catch (\Throwable $th) {
            throw new InvalidRouteException($routeFile, $th);
        }
    }
}
