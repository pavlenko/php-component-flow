<?php

namespace PE\Component\Flow;

interface FlowInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array;

    /**
     * @param NodeInterface $node
     *
     * @return FlowInterface
     */
    public function addNode(NodeInterface $node): FlowInterface;

    /**
     * @param LineInterface $line
     *
     * @return FlowInterface
     */
    public function addLine(LineInterface $line): FlowInterface;
}