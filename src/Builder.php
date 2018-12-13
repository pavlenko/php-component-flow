<?php

namespace PE\Component\Flow;

class Builder implements BuilderInterface
{
    /**
     * @var Node[]
     */
    private $nodes = [];

    /**
     * @var Line[]
     */
    private $lines = [];

    /**
     * @inheritDoc
     */
    public function createNode(string $name): NodeInterface
    {
        return ($this->nodes[] = new Node($name));
    }

    /**
     * @inheritDoc
     */
    public function createLine(string $name): LineInterface
    {
        return ($this->lines[] = new Line($name));
    }

    /**
     * @inheritDoc
     */
    public function createFlow(string $name): FlowInterface
    {
        return new Flow($name, $this->nodes, $this->lines);
    }
}