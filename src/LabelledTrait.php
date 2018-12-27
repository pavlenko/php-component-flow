<?php

namespace PE\Component\Flow;

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
     * @param string $label
     *
     * @return static
     */
    public function setLabel(string $label)
    {
        $this->label = $label;
        return $this;
    }
}