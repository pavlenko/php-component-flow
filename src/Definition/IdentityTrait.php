<?php

namespace PE\Component\Flow\Definition;

/**
 * @codeCoverageIgnore
 */
trait IdentityTrait
{
    /**
     * @var string
     */
    private $identity;

    /**
     * @return string
     */
    public function getID(): string
    {
        return $this->identity;
    }

    /**
     * @param string $id
     */
    public function setID(string $id): void
    {
        $this->identity = $id;
    }
}
