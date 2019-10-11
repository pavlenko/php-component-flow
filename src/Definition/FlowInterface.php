<?php

namespace PE\Component\Flow\Definition;

interface FlowInterface extends IdentityInterface, LabelledInterface
{
    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array;

    /**
     * @param NodeInterface[] $nodes
     */
    public function setNodes(array $nodes): void;

    /**
     * @param string $id
     *
     * @return NodeInterface|null
     */
    public function searchNode(string $id): ?NodeInterface;

    /**
     * @param NodeInterface $node
     */
    public function insertNode(NodeInterface $node): void;

    /**
     * @param NodeInterface $node
     */
    public function removeNode(NodeInterface $node): void;

    /**
     * @return LinkInterface[]
     */
    public function getLinks(): array;

    /**
     * @param LinkInterface[] $links
     */
    public function setLinks(array $links): void;

    /**
     * @param LinkInterface $link
     */
    public function insertLink(LinkInterface $link): void;

    /**
     * @param LinkInterface $link
     */
    public function removeLink(LinkInterface $link): void;
}
