<?php

namespace EasyRest\System\Routing;

use Closure;
use EasyRest\System\Request;

abstract class Middleware
{
    /**
     * Handle the middleware and call the next middleware in the queue
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    abstract public function handle(Request $request, Closure $next);
}
