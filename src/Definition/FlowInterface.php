<?php

namespace PE\Flow\Definition;

interface FlowInterface extends IdentityInterface, MetaInterface
{
    /**
     * @param NodeInterface[] $nodes
     * @return $this
     * @throws \RuntimeException If node already exists in flow
     */
    public function setNodes(array $nodes): self;

    /**
     * @return array<string, NodeInterface>
     */
    public function getNodes(): array;

    /**
     * @param NodeInterface $node
     * @return $this
     * @throws \RuntimeException If node already exists in flow
     */
    public function addNode(NodeInterface $node): self;

    /**
     * @param string $id
     * @return NodeInterface|null
     */
    public function getNode(string $id): ?NodeInterface;

    /**
     * @param string $id
     * @return $this
     */
    public function delNode(string $id): self;

    /**
     * @param PortInterface[] $ports
     * @return $this
     * @throws \RuntimeException If port already exists or port node not found
     */
    public function setPorts(array $ports): self;

    /**
     * @param string|null $nodeID
     * @return array<string, PortInterface>
     */
    public function getPorts(string $nodeID = null): array;

    /**
     * @param PortInterface $port
     * @return $this
     * @throws \RuntimeException If port already exists or port node not found
     */
    public function addPort(PortInterface $port): self;

    /**
     * @param string $id
     * @return PortInterface|null
     */
    public function getPort(string $id): ?PortInterface;

    /**
     * @param string $id
     * @return $this
     */
    public function delPort(string $id): self;

    /**
     * @param LinkInterface[] $links
     * @return $this
     */
    public function setLinks(array $links): self;

    /**
     * @param string|null $portID
     * @return array<string, LinkInterface>
     */
    public function getLinks(string $portID = null): array;

    /**
     * @param LinkInterface $link
     * @return $this
     * @throws \RuntimeException If link already exists or related ports not found or duplicate config
     */
    public function addLink(LinkInterface $link): self;

    /**
     * @param string $id
     * @return LinkInterface|null
     */
    public function getLink(string $id): ?LinkInterface;

    /**
     * @param string $id
     * @return $this
     */
    public function delLink(string $id): self;
}
