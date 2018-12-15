<?php

namespace PE\Component\Flow;

final class Flow
{
    /**
     * @var NodeInterface[]
     */
    private $nodes = [];

    /**
     * @var LineInterface[]
     */
    private $lines = [];

    /**
     * @param NodeInterface[] $nodes
     * @param LineInterface[] $lines
     */
    public function __construct(array $nodes = [], array $lines = [])
    {
        foreach ($nodes as $node) {
            $this->addNode($node);
        }

        foreach ($lines as $line) {
            $this->addLine($line);
        }
    }

    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @param string $id
     *
     * @return NodeInterface
     */
    public function getNode(string $id): NodeInterface
    {
        if (!array_key_exists($id, $this->nodes)) {
            throw new \InvalidArgumentException(sprintf('Node with id "%s" not found', $id));
        }

        return $this->nodes[$id];
    }

    /**
     * @param NodeInterface $node
     *
     * @return Flow
     */
    public function addNode(NodeInterface $node): Flow
    {
        if (array_key_exists($key = $node->getID(), $this->nodes)) {
            throw new \LogicException(sprintf('Node with name "%s" already exists', $key));
        }

        $this->nodes[$key] = $node;
        return $this;
    }

    /**
     * @return LineInterface[]
     */
    public function getLines(): array
    {
        return $this->lines;
    }

    /**
     * @param LineInterface $line
     *
     * @return Flow
     */
    public function addLine(LineInterface $line): Flow
    {
        if (!array_key_exists($source = $line->getSourceID(), $this->nodes)) {
            throw new \LogicException(sprintf('Source node with name "%s" not exists', $source));
        }

        if (!array_key_exists($target = $line->getTargetID(), $this->nodes)) {
            throw new \LogicException(sprintf('Target node with name "%s" not exists', $target));
        }

        $key = $source . '-->' . $target;

        if (array_key_exists($key, $this->lines)) {
            throw new \LogicException(sprintf('Line between nodes "%s" --> "%s" already exists', $source, $target));
        }

        //TODO validate count of sources and targets

        $this->lines[$key] = $line;
        return $this;
    }

    /**
     * @param NodeInterface $node
     *
     * @return NodeInterface[]
     */
    public function getSourcesOf(NodeInterface $node): array
    {
        $result = [];

        foreach ($this->lines as $line) {
            if ($line->getTargetID() === $node->getID()) {
                $result[] = $this->nodes[$line->getSourceID()];
            }
        }

        return $result;
    }

    /**
     * @param NodeInterface $node
     *
     * @return NodeInterface[]
     */
    public function getTargetsOf(NodeInterface $node): array
    {
        $result = [];

        foreach ($this->lines as $line) {
            if ($line->getSourceID() === $node->getID()) {
                $result[] = $this->nodes[$line->getTargetID()];
            }
        }

        return $result;
    }
}