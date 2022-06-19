<?php

namespace PE\Flow\Processing;

use PE\Flow\Definition\FlowInterface;
use PE\Flow\Definition\NodeInterface;

interface ProcessorInterface
{
    /**
     * @return int
     */
    public function getPriority(): int;

    /**
     * @param NodeInterface $node
     * @return bool
     */
    public function support(NodeInterface $node): bool;

    /**
     * @param NodeInterface $node
     * @param FlowInterface $flow
     * @return void
     */
    public function execute(NodeInterface $node, FlowInterface $flow): void;
}
