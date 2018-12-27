<?php

namespace PE\Component\Flow;

class Node implements NodeInterface
{
    use LabelledTrait;

    /**
     * @var string
     */
    private $id;

    /**
     * @var callable|null
     */
    private $process;

    /**
     * @param string   $id
     * @param callable $process
     */
    public function __construct(string $id, callable $process)
    {
        $this->id      = $id;
        $this->process = $process;
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
    public function process(Dataset $dataset): Dataset
    {
        $result = call_user_func($this->process, $dataset);

        if (!($result instanceof Dataset)) {
            throw new \LogicException('Result of callable must be instance of ' . Dataset::class);
        }

        return $result;
    }
}