<?php

namespace PE\Component\Flow;

interface FlowInterface
{
    /**
     * @return NodeInterface[]
     */
    public function getNodes();

    /**
     * @param NodeInterface $node
     *
     * @return FlowInterface
     */
    public function addNode(NodeInterface $node): FlowInterface;

    /**
     * @return LineInterface[]
     */
    public function getLines();

    /**
     * @param LineInterface $line
     *
     * @return FlowInterface
     */
    public function addLine(LineInterface $line): FlowInterface;

    /**
     * @param SubjectCollection|null $subjects
     */
    public function process(SubjectCollection $subjects = null): void;
}