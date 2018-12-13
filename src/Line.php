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
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @inheritDoc
     */
    public function setFrom(string $from): LineInterface
    {
        $this->from = $from;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getTo(): string
    {
        return $this->to;
    }

    /**
     * @inheritDoc
     */
    public function setTo(string $to): LineInterface
    {
        $this->to = $to;
        return $this;
    }
}