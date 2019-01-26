<?php
namespace EasyRest\System;

use ReflectionClass;
use Tightenco\Collect\Support\Collection;
use EasyRest\System\Exceptions\InvalidClassException;

final class Injector
{
    /**
     * @var Collection
     */
    private $instances;

    public function __construct()
    {
        $this->instances = collect([]);
    }

    /**
     * @param string $className
     * @return mixed
     * @throws InvalidClassException
     */
    public function inject(string $className)
    {
        try {
            $instance = $this->findClass($className);
            $reflection = new ReflectionClass($instance);
            if (!$this->instances->has($reflection->getName())) {
                $this->instances->put($reflection->getName(), $instance);
            }
            return $this->instances->get($reflection->getName());
        } catch (\Throwable $th) {
            throw new InvalidClassException("Error instanciating class", $className, $th);
        }
    }

    /**
     * @param string $className
     * @return mixed
     */
    private function findClass(string $className)
    {
        if (class_exists($className)) {
            return new $className;
        }

        if (class_exists("EasyRest\\$className")) {
            $className = "EasyRest\\$className";
            return new $className;
        }

        if (class_exists("EasyRest\System\\$className")) {
            $className = "EasyRest\System\\$className";
            return new $className;
        }

        if (class_exists("EasyRest\App\Controllers\\$className")) {
            $className = "EasyRest\App\Controllers\\$className";
            return new $className;
        }

        if (class_exists("EasyRest\App\Middlewares\\$className")) {
            $className = "EasyRest\App\Middlewares\\$className";
            return new $className;
        }

        $className = "EasyRest\App\\$className";
        return new $className;
    }
}
