<?php

namespace PE\Component\Flow\Processor;

use PE\Component\Flow\Definition\FlowInterface;
use Psr\Log\LoggerInterface;

interface FlowProcessorInterface
{
    /**
     * @param FlowInterface        $flow
     * @param LoggerInterface|null $logger
     *
     * @return int
     */
    public function process(FlowInterface $flow, LoggerInterface $logger = null): int;
}
