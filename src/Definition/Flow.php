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
        $this->nodes = [];

        foreach ($nodes as $node) {
            if (!($node instanceof NodeInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Node must be instance of %s, but got %s',
                    NodeInterface::class,
                    is_object($node) ? get_class($node) : gettype($node)
                ));
            }

            $this->nodes[] = $node;
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
