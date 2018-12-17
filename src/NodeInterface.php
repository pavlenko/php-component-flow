<?php

namespace PE\Component\Flow;

interface NodeInterface
{
    /**
     * Get node unique identifier
     *
     * @return string
     */
    public function getID(): \string;

    /**
     * Get node display label
     *
     * @return string|null
     */
    public function getLabel(): ?\string;

    /**
     * Get node max sources count, must be greater or equal 0
     *
     * @return int
     */
    public function getAllowedSourcesCount(): \int;

    /**
     * Get node max targets count, must be greater or equal 0
     *
     * @return int
     */
    public function getAllowedTargetsCount(): \int;

    /**
     * Apply node logic to subjects collection
     *
     * @param SubjectCollection $collection Subjects collection
     * @param array             $options    Custom node options, passed by reference to allow persist changed
     */
    public function process(SubjectCollection $collection, array &$options = []): void;
}