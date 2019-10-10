<?php

namespace PE\Component\Flow\Definition;

interface NodeValidatorInterface
{
    /**
     * @param NodeInterface $node
     *
     * @return bool
     */
    public function supports(NodeInterface $node): bool;

    /**
     * @param FlowInterface $flow
     * @param NodeInterface $node
     *
     * @return string[]
     */
    public function validate(FlowInterface $flow, NodeInterface $node): array;
}
