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
    public function process(SubjectsCollection $subjects = null): void
    {
        if ($this->callable) {
            call_user_func($this->callable, $subjects);
        } else {
            foreach ($subjects as $subject) {
                $subject->setState($this->name);
            }
        }
    }
}