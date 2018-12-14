<?php

namespace PE\Component\Flow;

interface NodeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param SubjectsCollection $subjects
     */
    public function process(SubjectsCollection $subjects): void;
}