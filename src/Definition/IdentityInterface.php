<?php

namespace PE\Component\Flow\Definition;

interface IdentityInterface
{
    /**
     * @return string
     */
    public function getID(): string;

    /**
     * @param string $id
     */
    public function setID(string $id): void;
}
