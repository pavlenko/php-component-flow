<?php

namespace PE\Component\Flow\Definition;

final class Flow implements FlowInterface
{
    use IdentityTrait;

    /**
     * @var NodeInterface[]
     */
    private $nodes = [];

    /**
     * @var LinkInterface[]
     */
    private $links = [];

    /**
     * @inheritDoc
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @inheritDoc
     */
    public function setNodes(array $nodes): void
    {
        //TODO check type
        $this->nodes = $nodes;
    }

    /**
     * @inheritDoc
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @inheritDoc
     */
    public function setLinks(array $links): void
    {
        //TODO check type
        $this->links = $links;
    }
}