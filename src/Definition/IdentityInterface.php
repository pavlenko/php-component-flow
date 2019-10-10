<?php

namespace PE\Component\Flow\Definition;

interface IdentityInterface
{
    /**
     * @return string
     */
    public function getIdentity(): string;

    /**
     * @param string $id
     */
    public function setIdentity(string $id): void;
}