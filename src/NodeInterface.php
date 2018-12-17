<?php

namespace PE\Component\Flow;

interface NodeInterface
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
     * @param array $options
     *
     * @return array
     */
    public function results(array &$options = []): array;

    /**
     * Apply node logic to subjects collection
     *
     * @param array $subjects Subjects collection
     * @param array $options  Custom node options, passed by reference to allow persist changed
     */
    public function process(array $subjects, array &$options = []): void;
}