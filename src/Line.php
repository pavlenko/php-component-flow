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
    private $source;

    /**
     * @var string
     */
    private $target;

    /**
     * @param string $name
     * @param string $source
     * @param string $target
     */
    public function __construct(string $name, string $source, string $target)
    {
        $this->name   = $name;
        $this->source = $source;
        $this->target = $target;
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
        return $this->source;
    }

    /**
     * @inheritDoc
     */
    public function getTarget(): string
    {
        return $this->target;
    }
}