<?php
namespace EasyRest\System\Exceptions;

use Exception;
use EasyRest\System\Routing\Route;
use EasyRest\System\Response\Response;

class InvalidRouteActionException extends Exception
{
    /**
     * @var Route
     */
    public $route;

    /**
     * @var string
     */
    protected $message;

    public function __construct(string $message, Route $route)
    {
        $this->message = $message;
        $this->route = $route;
        $finalMessage = sprintf('%s used by Route: "%s"', $this->message, $route->getUri());
        parent::__construct($finalMessage, Response::INTERNAL_SERVER_ERROR, null);
    }
}
