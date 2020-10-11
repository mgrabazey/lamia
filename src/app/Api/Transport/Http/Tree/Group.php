<?php

namespace Shop\Api\Transport\Http\Tree;

class Group
{
    /**
     * @var string
     */
    public $path;

    /**
     * @var Group[]
     */
    public $groups = [];

    /**
     * @var Handler[]
     */
    public $handlers = [];

    /**
     * @param string $path
     * @return static
     */
    public static function instance(string $path): self
    {
        return new static($path);
    }

    /**
     * Group constructor.
     * @param string $path
     */
    private function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * @param Group ...$groups
     * @return $this
     */
    public function addGroup(Group ...$groups): self
    {
        $this->groups = array_merge($this->groups, $groups);
        return $this;
    }

    /**
     * @param Handler ...$handlers
     * @return $this
     */
    public function addHandler(Handler ...$handlers): self
    {
        $this->handlers = array_merge($this->handlers, $handlers);
        return $this;
    }
}