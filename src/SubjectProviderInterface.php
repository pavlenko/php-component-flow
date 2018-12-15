<?php

namespace PE\Component\Flow;

interface SubjectProviderInterface
{
    /**
     * @param string $id
     *
     * @return SubjectCollection
     */
    public function getSubjectCollection(string $id): SubjectCollection;
}