<?php

namespace app\extensions\flow;

trait LabelledTrait
{
    /**
     * @var string|null
     */
    private $label;

    /**
     * @return string|null
     */
    public function getLabel(): ?string
    {
        return $this->label;
    }

    /**
     * @param string|null $label
     *
     * @return static
     */
    public function setLabel(string $label = null)
    {
        $this->label = $label;
        return $this;
    }
}
