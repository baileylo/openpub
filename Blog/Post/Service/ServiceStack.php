<?php

namespace Baileylo\Blog\Post\Service;

class ServiceStack
{
    private $specs;

    public function __construct()
    {
        $this->specs = new \SplStack();
    }

    public function push(/*$kernelClass, $args...*/)
    {
        if (func_num_args() === 0) {
            throw new \InvalidArgumentException("Missing argument(s) when calling push");
        }

        $spec = func_get_args();
        $this->specs->push($spec);

        return $this;
    }

    public function resolve(PostService $service)
    {
        $middlewares = array($service);

        foreach ($this->specs as $spec) {
            $args = $spec;
            $serviceClass = array_shift($args);


            array_unshift($args, $service);

            $reflection = new \ReflectionClass($serviceClass);
            $service = $reflection->newInstanceArgs($args);

            array_unshift($middlewares, $service);
        }

        return new StackedService($service, $middlewares);
    }
}
