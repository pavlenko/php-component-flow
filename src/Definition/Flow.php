<?php

namespace PE\Component\Flow\Definition;

final class Flow implements FlowInterface
{
    use IdentityTrait;
    use LabelledTrait;

    /**
     * @var NodeInterface[]
     */
    private $nodes = [];

    /**
     * @var LinkInterface[]
     */
    private $links = [];

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->identity = $id;
    }

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
        foreach ($this->nodes as $node) {
            $this->removeNode($node);
        }

        foreach ($nodes as $node) {
            $this->insertNode($node);
        }
    }

    /**
     * @inheritDoc
     */
    public function searchNode(string $id): ?NodeInterface
    {
        foreach ($this->nodes as $node) {
            if ($node->getID() === $id) {
                return $node;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function insertNode(NodeInterface $node): void
    {
        if (!in_array($node, $this->nodes, true)) {
            $this->nodes[] = $node;
        }
    }

    /**
     * @inheritDoc
     */
    public function removeNode(NodeInterface $node): void
    {
        if (false !== ($key = array_search($node, $this->nodes, true))) {
            unset($this->nodes[$key]);
        }

        $this->nodes = array_values($this->nodes);
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
        foreach ($this->links as $link) {
            $this->removeLink($link);
        }

        foreach ($links as $link) {
            $this->insertLink($link);
        }
    }

    /**
     * @inheritDoc
     */
    public function insertLink(LinkInterface $link): void
    {
        if (!in_array($link, $this->links, true)) {
            $this->links[] = $link;
        }
    }

    /**
     * @inheritDoc
     */
    public function removeLink(LinkInterface $link): void
    {
        if (false !== ($key = array_search($link, $this->links, true))) {
            unset($this->links[$key]);
        }

        $this->links = array_values($this->links);
    }
}
