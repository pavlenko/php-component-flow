<?php

namespace PE\Component\Flow\Util;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\LinkInterface;
use PE\Component\Flow\Definition\NodeInterface;
use PE\Component\Flow\Definition\PortInterface;

final class Finder
{
    /**
     * @param FlowInterface $flow
     * @param string        $type
     *
     * @return NodeInterface[]
     */
    public static function findNodes(FlowInterface $flow, string $type): array
    {
        $result = [];

        foreach ($flow->getNodes() as $node) {
            if ($node->getType() === $type) {
                $result[] = $node;
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return NodeInterface|null
     */
    public static function findLinkSourceNode(FlowInterface $flow, LinkInterface $link): ?NodeInterface
    {
        return $flow->searchNode($link->getSourceNodeID());
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return PortInterface|null
     */
    public static function findLinkSourcePort(FlowInterface $flow, LinkInterface $link): ?PortInterface
    {
        if ($block = $flow->searchNode($link->getSourceNodeID())) {
            return $block->searchPort($link->getSourcePortID());
        }

        return null;
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return NodeInterface|null
     */
    public static function findLinkTargetNode(FlowInterface $flow, LinkInterface $link): ?NodeInterface
    {
        return $flow->searchNode($link->getTargetNodeID());
    }

    /**
     * @param FlowInterface $flow
     * @param LinkInterface $link
     *
     * @return PortInterface|null
     */
    public static function findLinkTargetPort(FlowInterface $flow, LinkInterface $link): ?PortInterface
    {
        if ($block = $flow->searchNode($link->getTargetNodeID())) {
            return $block->searchPort($link->getTargetPortID());
        }

        return null;
    }

    /**
     * @param FlowInterface $flow
     * @param PortInterface $port
     *
     * @return NodeInterface[]
     */
    public static function findPortSourceNode(FlowInterface $flow, PortInterface $port): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            foreach ($flow->getNodes() as $block) {
                if ($block->getID() === $link->getSourceNodeID() && $port->getID() === $link->getTargetPortID()) {
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
     * @return NodeInterface|null
     */
    public static function findPortTargetNode(FlowInterface $flow, PortInterface $port): ?NodeInterface
    {
        foreach ($flow->getLinks() as $link) {
            if ($port->getID() === $link->getSourcePortID()) {
                return $flow->searchNode($link->getTargetNodeID());
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
     * @param NodeInterface $node
     *
     * @return NodeInterface[]
     */
    public static function findNodeSourceNodes(FlowInterface $flow, NodeInterface $node): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            foreach ($flow->getNodes() as $item) {
                if ($item->getID() === $link->getSourceNodeID() && $node->getID() === $link->getTargetNodeID()) {
                    $result[] = $item;
                }
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param NodeInterface $node
     *
     * @return NodeInterface[]
     */
    public static function findNodeTargetNodes(FlowInterface $flow, NodeInterface $node): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            foreach ($flow->getNodes() as $item) {
                if ($item->getID() === $link->getTargetNodeID() && $node->getID() === $link->getSourceNodeID()) {
                    $result[] = $item;
                }
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param NodeInterface $node
     *
     * @return LinkInterface[]
     */
    public static function findNodeSourceLinks(FlowInterface $flow, NodeInterface $node): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            if ($node->getID() === $link->getTargetNodeID()) {
                $result[] = $link;
            }
        }

        return $result;
    }

    /**
     * @param FlowInterface $flow
     * @param NodeInterface $node
     *
     * @return LinkInterface[]
     */
    public static function findNodeTargetLinks(FlowInterface $flow, NodeInterface $node): array
    {
        $result = [];

        foreach ($flow->getLinks() as $link) {
            if ($node->getID() === $link->getSourceNodeID()) {
                $result[] = $link;
            }
        }

        return $result;
    }
}
