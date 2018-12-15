<?php

namespace PETest\Component\Flow\Fixtures;

use PE\Component\Flow\Node;
use PE\Component\Flow\SubjectCollection;
use PE\Component\Flow\SubjectProviderInterface;

class SubjectProviderNode extends Node implements SubjectProviderInterface
{
    private $provider;

    /**
     * @inheritDoc
     */
    public function __construct(
        string $name,
        callable $provider,
        ?string $label = null,
        ?callable $callable = null
    ) {
        parent::__construct($name, $label, $callable);

        $this->provider = $provider;
    }

    /**
     * @inheritDoc
     */
    public function getSubjectCollection(string $id): SubjectCollection
    {
        return call_user_func($this->provider) ?: new SubjectCollection([]);
    }
}