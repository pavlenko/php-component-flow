<?php

namespace PE\Component\Flow;

interface LabelledInterface
{
    /**
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * @param string $label
     *
     * @return static
     */
    public function setLabel(string $label);
}