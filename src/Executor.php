<?php

namespace PE\Component\Flow;

final class Executor
{
    /**
     * @var SubjectProviderInterface
     */
    private $provider;

    /**
     * @param SubjectProviderInterface $provider
     */
    public function __construct(SubjectProviderInterface $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param Flow  $flow
     * @param array $options
     */
    public function executeFlow(Flow $flow, array &$options = []): void
    {
        foreach ($flow->getNodes() as $node) {
            $this->executeNode($node, $options);
        }
    }

    /**
     * @param NodeInterface $node
     * @param array         $options
     */
    public function executeNode(NodeInterface $node, array &$options = []): void
    {
        $collection = $node instanceof SubjectProviderInterface
            ? $node->getSubjectCollection($node->getID())
            : $this->provider->getSubjectCollection($node->getID());

        $node->process($collection, $options);
    }
}