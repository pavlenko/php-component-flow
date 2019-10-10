<?php

namespace PE\Component\Flow\Definition;

interface NodeValidatorInterface
{
    /**
     * @param FlowInterface $flow
     * @param NodeInterface $node
     *
     * @return string[]
     */
    public function validate(FlowInterface $flow, NodeInterface $node): array;
}
