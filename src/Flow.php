<?php

namespace PE\Component\Flow;

class Flow implements FlowInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var Node[]
     */
    private $nodes = [];

    /**
     * @var Line[]
     */
    private $lines = [];

    /**
     * @param string $name
     * @param Node[] $nodes
     * @param Line[] $lines
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
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @inheritDoc
     */
    public function addNode(NodeInterface $node): FlowInterface
    {
        foreach ($this->nodes as $item) {
            if ($item->getName() === $node->getName()) {
                throw new \LogicException(sprintf('Node with name "%s" already exists', $node->getName()));
            }
        }

        $this->nodes[] = $node;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addLine(LineInterface $line): FlowInterface
    {
        if (!array_key_exists($line->getSource(), $this->nodes)) {
            throw new \LogicException(sprintf('Source node with name "%s" not exists', $line->getSource()));
        }

        if (!array_key_exists($line->getTarget(), $this->nodes)) {
            throw new \LogicException(sprintf('Target node with name "%s" not exists', $line->getTarget()));
        }

        foreach ($this->lines as $item) {
            if ($item->getSource() === $line->getSource() && $item->getTarget() === $line->getTarget()) {
                throw new \LogicException(sprintf(
                    'Line between nodes "%s" and "%s" already exists',
                    $line->getSource(),
                    $line->getName()
                ));
            }
        }

        $this->lines[] = $line;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function process(SubjectInterface $subject): void
    {
        // TODO: Implement process() method.
        //TODO resolve processing node by subject state
        //TODO process subject via node targets
    }
}