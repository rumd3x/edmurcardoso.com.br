<?php
namespace EasyRest\System\Response;

use Tightenco\Collect\Support\Collection;

class JsonResponse extends Response
{
    /**
     * @var array
     */
    private $data;

    /**
     * @var bool
     */
    private $pretty;

    /**
     * @var bool
     */
    private $object;

    /**
     * Creates a response with the data
     *
     * @param mixed $data
     */
    public function __construct($data)
    {
        $this->data = $data;
        $this->pretty = false;
        $this->object = false;
    }

    /**
     * Makes the result JSON be printed pretty
     *
     * @return void
     */
    public function pretty()
    {
        $this->pretty = true;
        return $this;
    }

    /**
     * Forces the JSON data to be all objects
     *
     * @return void
     */
    public function object()
    {
        $this->object = true;
        return $this;
    }

    public function print()
    {
        $options = JSON_UNESCAPED_SLASHES;
        $options |= JSON_UNESCAPED_UNICODE;
        $options |= JSON_NUMERIC_CHECK;
        $options |= JSON_PRESERVE_ZERO_FRACTION;
        if ($this->object) {
            $options |= JSON_FORCE_OBJECT;
        }
        if ($this->pretty) {
            $options |= JSON_PRETTY_PRINT;
        }
        header('Content-Type: application/json');
        return json_encode($this->data, $options);
    }
}
