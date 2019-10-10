<?php

namespace PE\Component\Flow\Definition;

trait IdentityTrait
{
    /**
     * @var string
     */
    private $identity;

    /**
     * @return string
     */
    public function getIdentity(): string
    {
        return $this->identity;
    }

    /**
     * @param string $id
     */
    public function setIdentity(string $id): void
    {
        $this->identity = $id;
    }
}