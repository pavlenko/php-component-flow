<?php

namespace PE\Component\Flow;

interface SubjectProviderInterface
{
    /**
     * @return SubjectCollection
     */
    public function getSubjects(): SubjectCollection;
}