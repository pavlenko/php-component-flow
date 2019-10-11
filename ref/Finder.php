<?php

namespace app\extensions\flow;

final class Finder
{
    /**
     * @param FlowInterface $flow
     * @param string        $type
     *
     * @return BlockInterface[]
     */
    public static function findBlocks(FlowInterface $flow, string $type): array
    {
        $result = [];

        foreach ($flow->getBlocks() as $block) {
            if ($block->getType() === $type) {
                $result[] = $block;
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return BlockInterface|null
     */
    public static function findLinkSourceBlock(FlowInterface $flow, LinkInterface $link): ?BlockInterface
    {
        return $flow->searchBlock($link->getSourceBlockID());
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return PortInterface|null
     */
    public static function findLinkSourcePort(FlowInterface $flow, LinkInterface $link): ?PortInterface
    {
        if ($block = $flow->searchBlock($link->getSourceBlockID())) {
            return $block->searchPort($link->getSourcePortID());
        }

        return null;
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return BlockInterface|null
     */
    public static function findLinkTargetBlock(FlowInterface $flow, LinkInterface $link): ?BlockInterface
    {
        return $flow->searchBlock($link->getTargetBlockID());
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return PortInterface|null
     */
    public static function findLinkTargetPort(FlowInterface $flow, LinkInterface $link): ?PortInterface
    {
        if ($block = $flow->searchBlock($link->getTargetBlockID())) {
            return $block->searchPort($link->getTargetPortID());
        }

        return null;
    }

    /**
     * @param FlowInterface $flow
     * @param PortInterface $port
     *
     * @return BlockInterface[]
     */
    public static function findPortSourceBlocks(FlowInterface $flow, PortInterface $port): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            foreach ($flow->getBlocks() as $block) {
                if ($block->getID() === $link->getSourceBlockID() && $port->getID() === $link->getTargetPortID()) {
                    $result[] = $block;
                }
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param PortInterface $port
     *
     * @return LinkInterface[]
     */
    public static function findPortSourceLinks(FlowInterface $flow, PortInterface $port): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            if ($port->getID() === $link->getTargetPortID()) {
                $result[] = $link;
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param PortInterface $port
     *
     * @return BlockInterface|null
     */
    public static function findPortTargetBlock(FlowInterface $flow, PortInterface $port): ?BlockInterface
    {
        foreach ($flow->getLinks() as $link) {
            if ($port->getID() === $link->getSourcePortID()) {
                return $flow->searchBlock($link->getTargetBlockID());
            }
        }

        return null;
    }

    /**
     * @param FlowInterface $flow
     * @param PortInterface $port
     *
     * @return LinkInterface|null
     */
    public static function findPortTargetLink(FlowInterface $flow, PortInterface $port): ?LinkInterface
    {
        foreach ($flow->getLinks() as $link) {
            if ($port->getID() === $link->getSourcePortID()) {
                return $link;
            }
        }

        return null;
    }

    /**
     * @param FlowInterface $flow
     * @param BlockInterface $block
     *
     * @return BlockInterface[]
     */
    public static function findBlockSourceBlocks(FlowInterface $flow, BlockInterface $block): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            foreach ($flow->getBlocks() as $item) {
                if ($item->getID() === $link->getSourceBlockID() && $block->getID() === $link->getTargetBlockID()) {
                    $result[] = $item;
                }
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param BlockInterface $block
     *
     * @return BlockInterface[]
     */
    public static function findBlockTargetBlocks(FlowInterface $flow, BlockInterface $block): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            foreach ($flow->getBlocks() as $item) {
                if ($item->getID() === $link->getTargetBlockID() && $block->getID() === $link->getSourceBlockID()) {
                    $result[] = $item;
                }
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface  $flow
     * @param BlockInterface $block
     *
     * @return LinkInterface[]
     */
    public static function findBlockSourceLinks(FlowInterface $flow, BlockInterface $block): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            if ($block->getID() === $link->getTargetBlockID()) {
                $result[] = $link;
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface  $flow
     * @param BlockInterface $block
     *
     * @return LinkInterface[]
     */
    public static function findBlockTargetLinks(FlowInterface $flow, BlockInterface $block): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            if ($block->getID() === $link->getSourceBlockID()) {
                $result[] = $link;
            }
        }

        return $result;
    }
}
