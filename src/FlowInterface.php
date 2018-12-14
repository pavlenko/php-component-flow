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
     * @return LineInterface[]
     */
    public function getLines(): array;

    /**
     * @param LineInterface $line
     *
     * @return FlowInterface
     */
    public function addLine(LineInterface $line): FlowInterface;

    /**
     * @param SubjectInterface $subject
     */
    public function process(SubjectInterface $subject): void;
}