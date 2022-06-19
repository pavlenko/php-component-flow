<?php

namespace PE\Flow\Definition;

final class Link implements LinkInterface
{
    use IdentityTrait;

    private string $sourcePortID;
    private string $targetPortID;

    public function __construct(string $id, string $sourcePortID, string $targetPortID)
    {
        if ($sourcePortID === $targetPortID) {
            throw new \InvalidArgumentException('Source and target ports cannot be same');
        }

        $this->identity      = $id;
        $this->sourcePortID  = $sourcePortID;
        $this->targetPortID  = $targetPortID;
    }

    public function getSourcePortID(): string
    {
        return $this->sourcePortID;
    }

    public function getTargetPortID(): string
    {
        return $this->targetPortID;
    }

    public function getSourcePort(FlowInterface $flow): ?PortInterface
    {
        return $flow->getPort($this->sourcePortID);
    }

    public function getTargetPort(FlowInterface $flow): ?PortInterface
    {
        return $flow->getPort($this->targetPortID);
    }
}
