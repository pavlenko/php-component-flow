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
     * @param string $from
     *
     * @return LineInterface
     */
    public function setSource(string $from): LineInterface;

    /**
     * @return string
     */
    public function getTarget(): string;

    /**
     * @param string $to
     *
     * @return LineInterface
     */
    public function setTarget(string $to): LineInterface;
}