<?php

namespace PE\Flow\Definition;

interface NodeInterface extends DataInterface, IdentityInterface, MetaInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param FlowInterface $flow
     * @param string|null $type
     * @return array<string, PortInterface>
     */
    public function getPorts(FlowInterface $flow, string $type = null): array;
}
