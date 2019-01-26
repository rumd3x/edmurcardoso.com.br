<?php
namespace EasyRest\System\Response;

use Tightenco\Collect\Support\Collection;

class TextResponse extends Response
{
    /**
     * @var string
     */
    private $text;

    /**
     * Creates a response with the text
     *
     * @param string $text
     */
    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function print()
    {
        header('Content-Type: text/html');
        return (string) $this->text;
    }
}
