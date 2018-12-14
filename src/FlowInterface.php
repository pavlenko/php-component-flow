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
     * @param SubjectsCollection|null $subjects
     */
    public function process(SubjectsCollection $subjects = null): void;
}