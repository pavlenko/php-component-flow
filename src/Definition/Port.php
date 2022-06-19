<?php

namespace PE\Flow\Definition;

final class Port implements PortInterface
{
    use IdentityTrait;
    use MetaTrait;

    private string $type;
    private string $nodeID;

    public function __construct(string $id, string $type, string $nodeID, array $meta = [])
    {
        if (self::TYPE_I !== $type && self::TYPE_O !== $type) {
            throw new \InvalidArgumentException('Port type is invalid');
        }
        $this->identity = $id;
        $this->type     = $type;
        $this->nodeID   = $nodeID;
        $this->meta     = $meta;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getNodeID(): string
    {
        return $this->nodeID;
    }

    public function getNode(FlowInterface $flow): ?NodeInterface
    {
        return $flow->getNode($this->nodeID);
    }

    public function getLinks(FlowInterface $flow): array
    {
        return $flow->getLinks($this->getID());
    }
}
