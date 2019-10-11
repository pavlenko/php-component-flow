<?php

namespace app\extensions\flow;

trait IdentityTrait
{
    /**
     * @var string|null
     */
    private $identity;

    /**
     * @return string|null
     */
    public function getID(): ?string
    {
        return $this->identity;
    }

    /**
     * @param string $id
     *
     * @return static
     */
    public function setID(string $id)
    {
        $this->identity = $id;
        return $this;
    }
}
