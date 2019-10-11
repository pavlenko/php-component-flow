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
     * @param string $id
     *
     * @return NodeInterface|null
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
     * @param NodeInterface $node
     */
    public function insertNode(NodeInterface $node): void
    {
        if (!in_array($node, $this->nodes, true)) {
            $this->nodes[] = $node;
        }
    }

    /**
     * @param NodeInterface $node
     */
    public function removeNode(NodeInterface $node): void
    {
        if (false !== ($key = array_search($node, $this->nodes, true))) {
            unset($this->nodes[$key]);
        }
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
        $this->links = [];

        foreach ($links as $link) {
            if (!($link instanceof LinkInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Link must be instance of %s, but got %s',
                    LinkInterface::class,
                    is_object($link) ? get_class($link) : gettype($link)
                ));
            }

            $this->links[] = $link;
        }
    }
}
