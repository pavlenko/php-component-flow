<?php

namespace PE\Component\Flow;

class Builder
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
     * @param string $name
     *
     * @return Node
     */
    public function createNode(string $name): Node
    {
        return ($this->nodes[] = new Node($name));
    }

    /**
     * @param string $name
     *
     * @return Line
     */
    public function createLine(string $name): Line
    {
        return ($this->lines[] = new Line($name));
    }

    /**
     * @param string $name
     *
     * @return Flow
     */
    public function createFlow(string $name): Flow
    {
        return new Flow($name);
    }
}