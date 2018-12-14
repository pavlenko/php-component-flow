<?php

namespace PE\Component\Flow;

interface LineInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getSource(): string;

    /**
     * @return string
     */
    public function getTarget(): string;
}