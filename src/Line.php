<?php

namespace PE\Component\Flow;

class Line implements LineInterface
{
    /**
     * @var string
     */
    private $source;

    /**
     * @var string
     */
    private $target;

    /**
     * @param string $source
     * @param string $target
     */
    public function __construct(string $source, string $target)
    {
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * @inheritDoc
     */
    public function getSourceID(): string
    {
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function getTargetID(): string
    {
        return $this->target;
    }
}