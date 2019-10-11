<?php

namespace PE\Component\Flow\Validator;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\NodeInterface;

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
