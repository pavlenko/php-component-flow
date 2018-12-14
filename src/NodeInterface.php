<?php

namespace PE\Component\Flow;

interface NodeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param SubjectCollection|null $subjects
     */
    public function process(SubjectCollection $subjects = null): void;
}