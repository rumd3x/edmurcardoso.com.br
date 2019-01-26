<?php
namespace EasyRest\System\Exceptions;

use Exception;
use EasyRest\System\Request;
use EasyRest\System\Response\Response;

class RouteNotFoundException extends Exception
{
    /**
     * @var string
     */
    public $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $finalMessage = sprintf('No route found for current url');
        parent::__construct($finalMessage, Response::NOT_FOUND, null);
    }
}
