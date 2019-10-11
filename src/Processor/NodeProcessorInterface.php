<?php

namespace PE\Component\Flow\Processor;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\NodeInterface;
use Psr\Log\LoggerInterface;

interface NodeProcessorInterface
{
    /**
     * @param NodeInterface $node
     *
     * @return bool
     */
    public function supports(NodeInterface $node): bool;

    /**
     * @return int
     */
    public function measure(): int;

    /**
     * @param FlowInterface        $flow
     * @param NodeInterface        $node
     * @param LoggerInterface|null $logger
     *
     * @return int
     */
    public function process(FlowInterface $flow, NodeInterface $node, LoggerInterface $logger = null): int;
}
