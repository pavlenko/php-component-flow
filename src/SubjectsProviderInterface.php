<?php

namespace PE\Component\Flow;

interface SubjectsProviderInterface
{
    /**
     * @return SubjectsCollection
     */
    public function getSubjects(): SubjectsCollection;
}