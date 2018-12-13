<?php

namespace PE\Component\Flow;

interface FlowInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param Node $node
     *
     * @return FlowInterface
     */
    public function addNode(Node $node): FlowInterface;

    /**
     * @param Line $line
     *
     * @return FlowInterface
     */
    public function addLine(Line $line): FlowInterface;
}