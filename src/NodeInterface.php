<?php

namespace PE\Component\Flow;

interface NodeInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @param SubjectInterface $subject
     *
     * @return bool Returns true if success, false otherwise
     */
    public function process(SubjectInterface $subject): bool;
}