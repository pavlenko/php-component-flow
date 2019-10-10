<?php

namespace PE\Component\Flow\Definition;

interface LinkInterface extends IdentityInterface, LabelledInterface
{
    /**
     * @return string
     */
    public function getSourceBlockID(): string;

    /**
     * @param string $id
     */
    public function setSourceBlockID(string $id): void;

    /**
     * @return string
     */
    public function getSourcePortID(): string;

    /**
     * @param string $id
     */
    public function setSourcePortID(string $id): void;

    /**
     * @return string
     */
    public function getTargetBlockID(): string;

    /**
     * @param string $id
     */
    public function setTargetBlockID(string $id): void;

    /**
     * @return string
     */
    public function getTargetPortID(): string;

    /**
     * @param string $id
     */
    public function setTargetPortID(string $id): void;
}
