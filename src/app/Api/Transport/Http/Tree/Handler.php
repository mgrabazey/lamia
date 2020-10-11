<?php


namespace Shop\Api\Transport\Http\Tree;

use Closure;

class Handler
{
    /**
     * @var string
     */
    public $method;

    /**
     * @var string
     */
    public $path;

    /**
     * @var callable
     */
    public $callback;

    /**
     * @param string $method
     * @param string $path
     * @param callable $callback
     * @return static
     */
    public static function instance(string $method, string $path, callable $callback): self
    {
        return new static($method, $path, $callback);
    }

    private function __construct(string $method, string $path, callable $callback)
    {
        $this->method = $method;
        $this->path = $path;
        $this->callback = $callback;
    }
}