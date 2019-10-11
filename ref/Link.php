<?php

namespace app\extensions\flow;

final class Link implements LinkInterface
{
    use IdentityTrait;
    use LabelledTrait;
    use OptionsTrait;

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
    public function getSourceBlockID(): string
    {
        return $this->sourceBlockID;
    }

    /**
     * @inheritDoc
     */
    public function setSourceBlockID(string $id)
    {
        $this->sourceBlockID = $id;
        return $this;
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
    public function setSourcePortID(string $id)
    {
        $this->sourcePortID = $id;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTargetBlockID(): string
    {
        return $this->targetBlockID;
    }

    /**
     * @inheritDoc
     */
    public function setTargetBlockID(string $id)
    {
        $this->targetBlockID = $id;
        return $this;
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
    public function setTargetPortID(string $id)
    {
        $this->targetPortID = $id;
        return $this;
    }
}
