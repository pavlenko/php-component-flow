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
     * @var string|null
     */
    private $label;

    /**
     * @param string      $source
     * @param string      $target
     * @param string|null $label
     */
    public function __construct(\string $source, \string $target, \string $label = null)
    {
        $this->source = $source;
        $this->target = $target;
        $this->label  = $label;
    }

    /**
     * @inheritDoc
     */
    public function getSourceID(): \string
    {
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function getTargetID(): \string
    {
        return $this->target;
    }

    /**
     * @inheritDoc
     */
    public function getLabel(): ?\string
    {
        return $this->label;
    }
}