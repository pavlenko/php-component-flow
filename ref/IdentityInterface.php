<?php

namespace app\extensions\flow;

interface IdentityInterface
{
    /**
     * @return string|null
     */
    public function getID(): ?string;

    /**
     * @param string $id
     *
     * @return static
     */
    public function setID(string $id);
}
