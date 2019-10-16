<?php

namespace PE\Component\Flow\Definition;

interface LinkInterface extends IdentityInterface, LabelledInterface
{
    /**
     * @return string
     */
    public function getSourceNodeID(): string;

    /**
     * @param string $id
     */
    public function setSourceNodeID(string $id): void;

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
    public function getTargetNodeID(): string;

    /**
     * @param string $id
     */
    public function setTargetNodeID(string $id): void;

    /**
     * @return string
     */
    public function getTargetPortID(): string;

    /**
     * @param string $id
     */
    public function setTargetPortID(string $id): void;
}
