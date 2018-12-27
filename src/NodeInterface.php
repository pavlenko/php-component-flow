<?php

namespace PE\Component\Flow;

interface NodeInterface extends LabelledInterface
{
    /**
     * Get node unique identifier
     *
     * @return string
     */
    public function getID(): string;

    /**
     * Get node max sources count, must be greater or equal 0
     *
     * @return int
     */
    public function getAllowedSourcesCount(): int;

    /**
     * Get node max targets count, must be greater or equal 0
     *
     * @return int
     */
    public function getAllowedTargetsCount(): int;

    /**
     * @param Dataset $dataset
     *
     * @return Dataset
     */
    public function process(Dataset $dataset): Dataset;
}