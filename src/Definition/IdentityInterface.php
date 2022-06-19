<?php

namespace PE\Flow\Definition;

interface IdentityInterface
{
    /**
     * @return string|null
     */
    public function getID(): ?string;
}
