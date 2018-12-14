<?php

namespace PE\Component\Flow;

class Flow implements FlowInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var NodeInterface[]
     */
    private $nodes = [];

    /**
     * @var LineInterface[]
     */
    private $lines = [];

    /**
     * @param string          $name
     * @param NodeInterface[] $nodes
     * @param LineInterface[] $lines
     */
    public function __construct(string $name, array $nodes = [], array $lines = [])
    {
        $this->name = $name;

        foreach ($nodes as $node) {
            $this->addNode($node);
        }

        foreach ($lines as $line) {
            $this->addLine($line);
        }
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getNodes()
    {
        return $this->nodes;
    }

    /**
     * @inheritDoc
     */
    public function addNode(NodeInterface $node): FlowInterface
    {
        if (array_key_exists($key = $node->getName(), $this->nodes)) {
            throw new \LogicException(sprintf('Node with name "%s" already exists', $key));
        }

        $this->nodes[$key] = $node;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLines()
    {
        return $this->lines;
    }

    /**
     * @inheritDoc
     */
    public function addLine(LineInterface $line): FlowInterface
    {
        if (!array_key_exists($source = $line->getSource(), $this->nodes)) {
            throw new \LogicException(sprintf('Source node with name "%s" not exists', $source));
        }

        if (!array_key_exists($target = $line->getTarget(), $this->nodes)) {
            throw new \LogicException(sprintf('Target node with name "%s" not exists', $target));
        }

        $key = $source . '-->' . $target;

        if (array_key_exists($key, $this->lines)) {
            throw new \LogicException(sprintf('Line between nodes "%s" --> "%s" already exists', $source, $target));
        }

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
            if ($line->getTarget() === $node->getName()) {
                $result[] = $this->nodes[$line->getSource()];
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
            if ($line->getSource() === $node->getName()) {
                $result[] = $this->nodes[$line->getTarget()];
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function execute(string $state, SubjectsCollection $subjects = null): void
    {
        if (array_key_exists($state, $this->nodes)) {
            $current = $this->nodes[$state];
            $targets = $this->getTargetsOf($current);

            if (!$subjects && $current instanceof SubjectsProviderInterface) {
                $subjects = $current->getSubjects();
            }

            if ($subjects) {
                foreach ($targets as $target) {
                    $target->process($subjects);
                }
            }
        }
    }
}