<?php

namespace PE\Component\Flow;

interface ConnectionInterface
{
    /**
     * @return string
     */
    public function getID(): string;

    /**
     * @return string
     */
    public function getFrom(): string;

    /**
     * @return string
     */
    public function getTo(): string;
}