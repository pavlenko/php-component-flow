<?php

namespace PE\Flow\Definition;

trait IdentityTrait
{
    private ?string $identity = null;

    public function getID(): ?string
    {
        return $this->identity;
    }
}
