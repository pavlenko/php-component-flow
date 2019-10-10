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
     * @return LinkInterface[]
     */
    public function getLinks(): array;

    /**
     * @param LinkInterface[] $links
     */
    public function setLinks(array $links): void;
}
