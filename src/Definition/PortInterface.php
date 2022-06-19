<?php

namespace PE\Flow\Definition;

interface PortInterface extends IdentityInterface, MetaInterface
{
    public const TYPE_I  = 'I';
    public const TYPE_O  = 'O';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @return string
     */
    public function getNodeID(): string;

    /**
     * @param FlowInterface $flow
     * @return NodeInterface|null
     */
    public function getNode(FlowInterface $flow): ?NodeInterface;

    /**
     * @return array<string, LinkInterface>
     */
    public function getLinks(FlowInterface $flow): array;
}
