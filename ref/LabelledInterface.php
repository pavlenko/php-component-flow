<?php

namespace app\extensions\flow;

interface LabelledInterface
{
    /**
     * @return string|null
     */
    public function getLabel(): ?string;

    /**
     * @param string|null $label
     *
     * @return static
     */
    public function setLabel(string $label = null);
}
