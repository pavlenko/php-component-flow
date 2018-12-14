<?php

namespace PE\Component\Flow;

interface NodeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param SubjectsCollection|null $subjects
     */
    public function process(SubjectsCollection $subjects = null): void;
}