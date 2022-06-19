<?php

namespace PE\Flow\Definition;

final class Flow implements FlowInterface
{
    use IdentityTrait;
    use MetaTrait;

    /**
     * @var array<string, NodeInterface>
     */
    private array $nodes = [];

    /**
     * @var array<string, PortInterface>
     */
    private array $ports  = [];

    /**
     * @var array<string, LinkInterface>
     */
    private array $links  = [];

    public function __construct(string $id, array $meta = [])
    {
        $this->identity = $id;
        $this->meta     = $meta;
    }

    public function setNodes(array $nodes): FlowInterface
    {
        $this->nodes = [];
        foreach ($nodes as $node) {
            $this->addNode($node);
        }
        return $this;
    }

    public function getNodes(): array
    {
        return $this->nodes;
    }

    public function addNode(NodeInterface $node): self
    {
        if (array_key_exists($node->getID(), $this->nodes)) {
            throw new \RuntimeException(sprintf('Node with id %s already exists in flow', $node->getID()));
        }
        $this->nodes[$node->getID()] = $node;
        return $this;
    }

    public function getNode(string $id): ?NodeInterface
    {
        return $this->nodes[$id] ?? null;
    }

    public function delNode(string $id): self
    {
        unset($this->nodes[$id]);
        return $this;
    }

    public function setPorts(array $ports): self
    {
        $this->ports = [];
        foreach ($ports as $port) {
            $this->addPort($port);
        }
        return $this;
    }

    public function getPorts(string $nodeID = null): array
    {
        if (null === $nodeID) {
            return $this->ports;
        }
        return array_filter($this->ports, fn(PortInterface $p) => $p->getNodeID() === $nodeID);
    }

    public function addPort(PortInterface $port): self
    {
        if (array_key_exists($port->getID(), $this->ports)) {
            throw new \RuntimeException(sprintf('Port with id %s already exists in flow', $port->getID()));
        }
        if (!array_key_exists($port->getNodeID(), $this->nodes)) {
            throw new \RuntimeException(sprintf('Node with id %s not found in flow', $port->getNodeID()));
        }
        $this->ports[$port->getID()] = $port;
        return $this;
    }

    public function getPort(string $id): ?PortInterface
    {
        return $this->ports[$id] ?? null;
    }

    public function delPort(string $id): self
    {
        unset($this->ports[$id]);
        return $this;
    }

    public function setLinks(array $links): self
    {
        $this->links = [];
        foreach ($links as $link) {
            $this->addLink($link);
        }
        return $this;
    }

    public function getLinks(string $portID = null): array
    {
        if (null === $portID) {
            return $this->links;
        }
        return array_filter(
            $this->links,
            fn(LinkInterface $l) => $l->getSourcePortID() === $portID || $l->getTargetPortID() === $portID
        );
    }

    public function addLink(LinkInterface $link): self
    {
        if (array_key_exists($link->getID(), $this->links)) {
            throw new \RuntimeException(sprintf('Link with id %s already exists in flow', $link->getID()));
        }
        $missing = [];
        if (!array_key_exists($link->getSourcePortID(), $this->ports)) {
            $missing[] = sprintf('Source port with id %s not found in flow', $link->getSourcePortID());
        }
        if (!array_key_exists($link->getTargetPortID(), $this->ports)) {
            $missing[] = sprintf('Target port with id %s not found in flow', $link->getTargetPortID());
        }
        if (!empty($missing)) {
            throw new \RuntimeException(implode('; ', $missing));
        }
        $key = $link->getSourcePortID() . '---' . $link->getTargetPortID();
        foreach ($this->links as $item) {
            if ($item->getSourcePortID() . '---' . $item->getTargetPortID() === $key) {
                throw new \RuntimeException(sprintf('Duplicate link with id %s exists', $item->getID()));
            }
        }
        $this->links[$link->getID()] = $link;
        return $this;
    }

    public function getLink(string $id): ?LinkInterface
    {
        return $this->links[$id] ?? null;
    }

    public function delLink(string $id): self
    {
        unset($this->links[$id]);
        return $this;
    }
}
