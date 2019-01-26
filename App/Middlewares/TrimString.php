<?php

namespace EasyRest\App\Middlewares;

use Closure;
use EasyRest\System\Request;
use EasyRest\System\Routing\Middleware;
use EasyRest\System\Routing\MiddlewareInterface;

class TrimString extends Middleware implements MiddlewareInterface
{
    public function handle(Request $request, Closure $next)
    {
        foreach ($request->payload as $key => $value) {
            $request->payload->put($key, trim($value));
        }
        $next($request);
    }
}
