<?php

namespace PE\Component\Flow;

class Transition
{
    private $id;
    private $from;
    private $to;

    /**
     * @param string $id
     * @param string $from
     * @param string $to
     */
    public function __construct(string $id, string $from, string $to)
    {
        $this->id   = $id;
        $this->from = $from;
        $this->to   = $to;
    }

    /**
     * @return string
     */
    public function getID(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getFrom(): string
    {
        return $this->from;
    }

    /**
     * @return string
     */
    public function getTo(): string
    {
        return $this->to;
    }
}