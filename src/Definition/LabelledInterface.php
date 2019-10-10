<?php

namespace PE\Component\Flow\Definition;

interface LabelledInterface
{
    /**
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * @param string $label
     */
    public function setLabel(string $label): void;
}
