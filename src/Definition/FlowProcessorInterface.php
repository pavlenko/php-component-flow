<?php

namespace PE\Component\Flow\Definition;

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
