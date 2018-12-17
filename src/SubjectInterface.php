<?php

namespace PE\Component\Flow;

interface SubjectInterface
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