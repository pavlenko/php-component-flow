<?php

namespace PE\Component\Flow;

final class SubjectsCollection implements \Iterator
{
    /**
     * @var int
     */
    private $pointer = 0;

    /**
     * @var array
     */
    private $keys = [];

    /**
     * @var SubjectInterface[]
     */
    private $values = [];

    /**
     * @param SubjectInterface[] $subjects
     */
    public function __construct(array $subjects)
    {
        foreach ($subjects as $subject) {
            if (!($subject instanceof SubjectInterface)) {
                throw new \InvalidArgumentException();
            }
        }

        $this->keys   = array_keys($subjects);
        $this->values = array_values($subjects);
    }

    /**
     * @inheritDoc
     */
    public function current()
    {
        return $this->values[$this->pointer];
    }

    /**
     * @inheritDoc
     */
    public function next()
    {
        $this->pointer++;
    }

    /**
     * @inheritDoc
     */
    public function key()
    {
        return $this->keys[$this->pointer];
    }

    /**
     * @inheritDoc
     */
    public function valid()
    {
        return isset($this->values[$this->pointer]);
    }

    /**
     * @inheritDoc
     */
    public function rewind()
    {
        $this->pointer = 0;
    }
}