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
    public function addNode(Node $node): FlowInterface
    {
        foreach ($this->nodes as $item) {
            if ($item->getName() == $node->getName()) {
                throw new \LogicException(sprintf('Node with name "%s" already exists', $node->getName()));
            }
        }

        $this->nodes[] = $node;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function addLine(Line $line): FlowInterface
    {
        foreach ($this->lines as $item) {
            if ($item->getFrom() == $line->getFrom() && $item->getTo() == $line->getTo()) {
                throw new \LogicException(sprintf(
                    'Line between nodes "%s" and "%s" already exists',
                    $line->getFrom(),
                    $line->getName()
                ));
            }
        }

        $this->lines[] = $line;
        return $this;
    }
}