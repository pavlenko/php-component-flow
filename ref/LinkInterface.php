<?php

namespace app\extensions\flow;

interface LinkInterface extends IdentityInterface, LabelledInterface, OptionsInterface
{
    /**
     * @return string
     */
    public function getSourceBlockID(): string;

    /**
     * @param string $id
     *
     * @return static
     */
    public function setSourceBlockID(string $id);

    /**
     * @return string
     */
    public function getSourcePortID(): string;

    /**
     * @param string $id
     *
     * @return static
     */
    public function setSourcePortID(string $id);

    /**
     * @return string
     */
    public function getTargetBlockID(): string;

    /**
     * @param string $id
     *
     * @return static
     */
    public function setTargetBlockID(string $id);

    /**
     * @return string
     */
    public function getTargetPortID(): string;

    /**
     * @param string $id
     *
     * @return static
     */
    public function setTargetPortID(string $id);
}
