<?php

namespace PETest\Component\Flow\Fixtures;

use PE\Component\Flow\Node;

class ConfigurableNode extends Node
{
    /**
     * @var int
     */
    private $allowedSourcesCount;

    /**
     * @var int
     */
    private $allowedTargetsCount;

    /**
     * @inheritDoc
     */
    public function __construct(
        string $name,
        int $allowedSourcesCount,
        int $allowedTargetsCount,
        ?string $label = null,
        ?callable $callable = null
    ) {
        parent::__construct($name, $label, $callable);

        $this->allowedSourcesCount = $allowedSourcesCount;
        $this->allowedTargetsCount = $allowedTargetsCount;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedSourcesCount(): int
    {
        return $this->allowedSourcesCount;
    }

    /**
     * @inheritDoc
     */
    public function getAllowedTargetsCount(): int
    {
        return $this->allowedTargetsCount;
    }
}