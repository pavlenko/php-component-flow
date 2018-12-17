<?php

namespace PE\Component\Flow;

class Subject implements SubjectInterface
{
    /**
     * @var string
     */
    private $state;

    /**
     * @param string $state
     */
    public function __construct(\string $state = null)
    {
        $this->state = $state;
    }

    /**
     * @inheritDoc
     */
    public function getState(): \string
    {
        return $this->state;
    }

    /**
     * @inheritDoc
     */
    public function setState(\string $state): void
    {
        $this->state = $state;
    }
}