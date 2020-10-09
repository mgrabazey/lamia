<?php

namespace Shop\Api\Transport\Http;

class Request
{
    /**
     * @var array
     */
    private $vars = [];

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function get(string $name, $default = null)
    {
        return $_GET[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function post(string $name, $default = null)
    {
        return $_POST[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param null $default
     * @return mixed
     */
    public function var(string $name, $default = null)
    {
        return $this->vars[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param $value
     */
    public function addVar(string $name, $value)
    {
        $this->vars[$name] = $value;
    }
}