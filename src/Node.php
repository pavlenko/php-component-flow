<?php

namespace PE\Component\Flow;

class Node implements NodeInterface
{
    use Label;

    /**
     * @var string
     */
    private $id;

    /**
     * @var callable|null
     */
    private $processCB;

    /**
     * @var callable|null
     */
    private $resultsCB;

    /**
     * @var callable|null
     */
    private $callable;

    /**
     * @param string        $name
     * @param callable|null $processCB
     * @param callable|null $resultsCB
     */
    public function __construct(string $name, callable $processCB = null, callable $resultsCB = null)
    {
        $this->id        = $name;
        $this->processCB = $processCB;
        $this->resultsCB = $resultsCB;
    }

    /**
     * @inheritDoc
     */
    public function getID(): string
    {
        return $this->id;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedSourcesCount(): int
    {
        return PHP_INT_MAX;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedTargetsCount(): int
    {
        return PHP_INT_MAX;
    }

    /**
     * @inheritDoc
     */
    public function results(array &$options = []): array
    {
        $results = [];

        if ($this->resultsCB) {
            $results = call_user_func($this->resultsCB, $options, $this);
        }

        return is_array($results) ? $results : [];
    }

    /**
     * @inheritDoc
     */
    public function process(array $subjects, array &$options = []): void
    {
        if ($this->processCB) {
            call_user_func($this->processCB, $subjects, $options, $this);
        }
    }
}