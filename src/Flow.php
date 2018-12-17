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
     * @var string|null
     */
    private $label;

    /**
     * @var int[]
     */
    private $sources = [];

    /**
     * @var int[]
     */
    private $targets = [];

    /**
     * @param NodeInterface[] $nodes
     * @param LineInterface[] $lines
     * @param string          $label
     */
    public function __construct(array $nodes = [], array $lines = [], \string $label = null)
    {
        foreach ($nodes as $node) {
            $this->addNode($node);
        }

        foreach ($lines as $line) {
            $this->addLine($line);
        }

        $this->label = $label;
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
    public function getNode(\string $id): NodeInterface
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

        if ($this->nodes[$source]->getAllowedTargetsCount() <= ($this->targets[$line->getTargetID()] ?? 0)) {
            throw new \LogicException(sprintf('Source node "%s" allowed targets count reached', $source));
        }

        if ($this->nodes[$target]->getAllowedSourcesCount() <= ($this->sources[$line->getTargetID()] ?? 0)) {
            throw new \LogicException(sprintf('Target node "%s" allowed sources count reached', $source));
        }

        $this->sources[$line->getSourceID()] = ($this->sources[$line->getSourceID()] ?? 0) + 1;
        $this->targets[$line->getTargetID()] = ($this->targets[$line->getTargetID()] ?? 0) + 1;

        $this->lines[$key] = $line;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLabel(): ?\string
    {
        return $this->label;
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