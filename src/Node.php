<?php

namespace PE\Component\Flow;

class Node implements NodeInterface, SubjectProviderInterface
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var callable|null
     */
    private $process;

    /**
     * @var callable|null
     */
    private $getSubjects;

    /**
     * @param string        $name
     * @param callable|null $process
     * @param callable|null $getSubjects
     */
    public function __construct(string $name, callable $process = null, callable $getSubjects = null)
    {
        $this->name        = $name;
        $this->process     = $process;
        $this->getSubjects = $getSubjects;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @inheritDoc
     */
    public function getSubjects(): SubjectCollection
    {
        $subjects = null;

        if ($this->getSubjects) {
            $subjects = call_user_func($this->getSubjects) ?: null;
        }

        return $subjects;
    }

    /**
     * @inheritDoc
     */
    public function process(SubjectCollection $subjects = null): void
    {
        if ($this->process) {
            call_user_func($this->process, $this, $subjects);
        }
    }
}