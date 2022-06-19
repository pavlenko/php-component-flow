<?php

namespace PE\Flow\Definition;

final class Node implements NodeInterface
{
    use DataTrait;
    use IdentityTrait;
    use MetaTrait;

    private string $type;

    public function __construct(string $id, string $type, array $meta = [])
    {
        $this->identity = $id;
        $this->type     = $type;
        $this->meta     = $meta;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getPorts(FlowInterface $flow, string $type = null): array
    {
        $ports = $flow->getPorts($this->getID());
        if (null === $type) {
            return $ports;
        }
        return array_filter($ports, fn(PortInterface $port) => $port->getType() === $type);
    }
}
