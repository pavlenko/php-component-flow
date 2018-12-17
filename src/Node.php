<?php

namespace PE\Component\Flow;

class Node implements NodeInterface
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string|null
     */
    private $label;

    /**
     * @var callable|null
     */
    private $callable;

    /**
     * @param string        $name
     * @param string|null   $label
     * @param callable|null $callable
     */
    public function __construct(\string $name, \string $label = null, callable $callable = null)
    {
        $this->id       = $name;
        $this->label    = $label;
        $this->callable = $callable;
    }

    /**
     * @inheritDoc
     */
    public function getID(): \string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getLabel(): ?\string
    {
        return $this->label;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedSourcesCount(): \int
    {
        return PHP_INT_MAX;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedTargetsCount(): \int
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