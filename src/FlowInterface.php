<?php

namespace PE\Component\Flow;

interface FlowInterface
{
    /**
     * @return BlockInterface[]
     */
    public function getBlocks(): array;

    /**
     * @param string $id
     *
     * @return BlockInterface|null
     */
    public function getBlock(string $id): ?BlockInterface;

    /**
     * @param string         $id
     * @param BlockInterface $block
     *
     * @return FlowInterface
     */
    public function addBlock(string $id, BlockInterface $block): FlowInterface;

    /**
     * @param string $id
     *
     * @return FlowInterface
     */
    public function removeBlock(string $id): FlowInterface;

    /**
     * @return void
     */
    public function execute(): void;
}