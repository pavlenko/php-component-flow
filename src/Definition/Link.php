<?php

namespace PE\Component\Flow\Definition;

/**
 * @codeCoverageIgnore
 */
final class Link implements LinkInterface
{
    use IdentityTrait;
    use LabelledTrait;

    /**
     * @var string
     */
    private $sourceBlockID;

    /**
     * @var string
     */
    private $sourcePortID;

    /**
     * @var string
     */
    private $targetBlockID;

    /**
     * @var string
     */
    private $targetPortID;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->identity = $id;
    }

    /**
     * @inheritDoc
     */
    public function getSourceNodeID(): string
    {
        return $this->sourceBlockID;
    }

    /**
     * @inheritDoc
     */
    public function setSourceNodeID(string $id): void
    {
        $this->sourceBlockID = $id;
    }

    /**
     * @inheritDoc
     */
    public function getSourcePortID(): string
    {
        return $this->sourcePortID;
    }

    /**
     * @inheritDoc
     */
    public function setSourcePortID(string $id): void
    {
        $this->sourcePortID = $id;
    }

    /**
     * @inheritDoc
     */
    public function getTargetNodeID(): string
    {
        return $this->targetBlockID;
    }

    /**
     * @inheritDoc
     */
    public function setTargetNodeID(string $id): void
    {
        $this->targetBlockID = $id;
    }

    /**
     * @inheritDoc
     */
    public function getTargetPortID(): string
    {
        return $this->targetPortID;
    }

    /**
     * @inheritDoc
     */
    public function setTargetPortID(string $id): void
    {
        $this->targetPortID = $id;
    }
}
