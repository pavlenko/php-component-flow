<?php

namespace PE\Component\Flow;

class Line implements LineInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $from;

    /**
     * @var string
     */
    private $to;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getSource(): string
    {
        return $this->from;
    }

    /**
     * @inheritDoc
     */
    public function setSource(string $from): LineInterface
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTarget(): string
    {
        return $this->to;
    }

    /**
     * @inheritDoc
     */
    public function setTarget(string $to): LineInterface
    {
        $this->to = $to;
        return $this;
    }
}