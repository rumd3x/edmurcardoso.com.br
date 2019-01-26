<?php
namespace EasyRest\System\Exceptions;

use Exception;
use Throwable;
use EasyRest\System\Response\Response;

class InvalidClassException extends Exception
{
    /**
     * @var string
     */
    public $className;

    /**
     * @var string
     */
    public $message;

    public function __construct(string $message, string $className, Throwable $previous = null)
    {
        $this->message = $message;
        $this->className = $className;
        $finalMessage = sprintf('Class "%s": %s', $this->className, $this->message);
        parent::__construct($finalMessage, Response::INTERNAL_SERVER_ERROR, $previous);
    }
}
