<?php

namespace EasyRest\System\Routing;

use Closure;
use EasyRest\System\Request;

interface MiddlewareInterface
{
    /**
     * Handle the middleware and call the next one in the queue
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next);
}
