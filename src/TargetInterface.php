<?php

namespace PE\Component\Flow;

interface TargetInterface
{
    /**
     * @return string
     */
    public function getState(): string;

    /**
     * @param string $state
     */
    public function setState(string $state);
}