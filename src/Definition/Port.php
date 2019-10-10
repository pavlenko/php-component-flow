<?php

namespace PE\Component\Flow\Definition;

final class Port implements PortInterface
{
    use IdentityTrait;

    /**
     * @var string
     */
    private $type;

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
}