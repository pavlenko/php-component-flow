<?php

namespace PE\Component\Flow\Definition;

interface NodeInterface extends IdentityInterface
{
    /**
     * @param string|null $type
     *
     * @return PortInterface[]
     */
    public function getPorts(?string $type = null): array;

    /**
     * @param PortInterface[] $ports
     */
    public function setPorts(array $ports): void;
}