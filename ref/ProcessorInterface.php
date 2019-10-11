<?php

namespace app\extensions\flow;

interface ProcessorInterface
{
    /**
     * @return int
     */
    public function getPriority(): int;

    /**
     * @param BlockInterface $block
     *
     * @return bool
     */
    public function supports(BlockInterface $block): bool;

    /**
     * @param FlowInterface  $flow
     * @param BlockInterface $block
     *
     * @return int
     */
    public function execute(FlowInterface $flow, BlockInterface $block): int;

    /**
     * @param FlowInterface  $flow
     * @param BlockInterface $block
     *
     * @return string[]
     */
    public function validate(FlowInterface $flow, BlockInterface $block): array;
}
