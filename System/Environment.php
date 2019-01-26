<?php
namespace EasyRest\System;

use IteratorAggregate;
use Tightenco\Collect\Support\Collection;
use Symfony\Component\Filesystem\Filesystem;
use EasyRest\System\Exceptions\InvalidFileException;

final class Environment
{
    /**
     * @var Collection
     */
    private $vars;

    public function __construct()
    {
        $this->vars = collect([]);
    }

    /**
     * Loads environment data from a JSON file
     *
     * @param string $filePath
     * @return self
     * @throws InvalidFileException
     */
    public function parseFile(string $filePath)
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->exists($filePath) || !is_file($filePath)) {
            throw new InvalidFileException("File does not exists", $filePath);
        }

        $fileData = json_decode(file_get_contents($filePath), true);
        if ($fileData === null) {
            throw new InvalidFileException("File does not contain a valid JSON string", $filePath);
        }

        $fileData = collect($fileData);
        foreach ($fileData as $envVar => $envData) {
            $this->put($envVar, $envData);
        }

        if (!$this->vars->has('server')) {
            $this->vars->put('server', 'production');
        }

        return $this;
    }

    /**
     * Makes a variable available in the Environment class
     *
     * @param string $index
     * @param mixed $value
     * @return self
     */
    private function put(string $index, $value)
    {
        if ($this->vars->has($index)) {
            return $this;
        }

        $this->vars->put($index, $value);
        return $this;
    }

    /**
     * Returns the environment variable
     *
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        return $this->vars->get($key);
    }
}
