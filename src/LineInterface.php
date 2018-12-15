<?php

namespace PE\Component\Flow;

interface LineInterface
{
    /**
     * @return string
     */
    public function getSourceID(): string;

    /**
     * @return string
     */
    public function getTargetID(): string;

    /**
     * @return string|null
     */
    public function getLabel(): ?string;
}