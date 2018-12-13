<?php

namespace PE\Component\Flow;

interface BuilderInterface
{
    /**
     * @param string $name
     *
     * @return NodeInterface
     */
    public function createNode(string $name): NodeInterface;

    /**
     * @param string $name
     *
     * @return LineInterface
     */
    public function createLine(string $name): LineInterface;

    /**
     * @param string $name
     *
     * @return FlowInterface
     */
    public function createFlow(string $name): FlowInterface;
}