<?php

namespace PE\Component\Flow;

class Node implements NodeInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable|null
     */
    private $callable;

    /**
     * @param string        $name
     * @param callable|null $callable
     */
    public function __construct(string $name, callable $callable = null)
    {
        $this->name     = $name;
        $this->callable = $callable;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function process(SubjectInterface $subject): bool
    {
        if ($this->callable) {
            return (bool) call_user_func($this->callable, $subject);
        }

        return true;
    }
}