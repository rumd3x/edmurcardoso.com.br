<?php
namespace EasyRest\System\Response;

interface ResponseInterface
{
    /**
     * Converts the response data to text
     *
     * @return string
     */
    public function print();
}
