<?php

namespace PE\Component\Flow;

class Node implements NodeInterface
{
    use Label;

    /**
     * @var string
     */
    private $id;

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
        $this->id       = $name;
        $this->callable = $callable;
    }

    /**
     * @inheritDoc
     */
    public function getID(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedSourcesCount(): int
    {
        return PHP_INT_MAX;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedTargetsCount(): int
    {
        return PHP_INT_MAX;
    }

    /**
     * @inheritDoc
     */
    public function process(SubjectCollection $collection, array &$options = []): void
    {
        if ($this->callable) {
            call_user_func($this->callable, $this, $collection, $options);
        }
    }
}