<?php

namespace PE\Flow\Validation;

use PE\Flow\Definition\NodeInterface;
use PE\Flow\Definition\FlowInterface;

interface ConstraintInterface
{
    public function validate(NodeInterface $node, FlowInterface $flow, array &$messages): void;
}
