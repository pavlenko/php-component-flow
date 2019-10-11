<?php

namespace PE\Component\Flow\Definition;

/**
 * @codeCoverageIgnore
 */
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
     */
    public function setLabel(string $label):void
    {
        $this->label = $label;
    }
}
