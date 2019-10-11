<?php

namespace app\extensions\flow;

interface PortInterface extends IdentityInterface, LabelledInterface, OptionsInterface
{
    const TYPE_I  = 'I';
    const TYPE_O  = 'O';
    const TYPE_IO = 'IO';

    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string $type
     *
     * @return static
     */
    public function setType(string $type);
}
