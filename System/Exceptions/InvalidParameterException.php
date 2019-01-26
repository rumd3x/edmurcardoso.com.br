<?php
namespace EasyRest\System\Exceptions;

use Exception;
use Throwable;
use EasyRest\System\Response\Response;

class InvalidParameterException extends Exception
{
    public function __construct(string $param, string $expected, string $given = null)
    {
        $finalMessage = sprintf('Parameter "%s" is not valid. Expected %s.', $param, $expected, $given ?: " $given given.");
        parent::__construct($finalMessage, Response::BAD_REQUEST, null);
    }
}
