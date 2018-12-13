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
    public function getFrom(): string;

    /**
     * @param string $from
     *
     * @return LineInterface
     */
    public function setFrom(string $from): LineInterface;

    /**
     * @return string
     */
    public function getTo(): string;

    /**
     * @param string $to
     *
     * @return LineInterface
     */
    public function setTo(string $to): LineInterface;
}