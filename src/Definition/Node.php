<?php

namespace PE\Component\Flow\Definition;

final class Node implements NodeInterface
{
    use IdentityTrait;

    /**
     * @var PortInterface[]
     */
    private $ports = [];

    /**
     * @inheritDoc
     */
    public function getPorts(?string $type = null): array
    {
        //TODO filter
        return $this->ports;
    }

    /**
     * @inheritDoc
     */
    public function setPorts(array $ports): void
    {
        //TODO check type
        $this->ports = $ports;
    }
}