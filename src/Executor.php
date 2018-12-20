<?php

namespace PE\Component\Flow;

final class Executor
{
    /**
     * @var Flow
     */
    private $flow;

    /**
     * @param Flow $flow
     */
    public function __construct(Flow $flow)
    {
        $this->flow = $flow;
    }

    /**
     * @param array       $options
     * @param string|null $nodeID
     */
    public function execute(array &$options = [], string $nodeID = null): void
    {
        foreach ($this->flow->getNodes() as $node) {
            if (null === $nodeID || $node->getID() === $nodeID) {
                if (count($sources = $this->flow->getSourcesOf($node))) {
                    foreach ($sources as $source) {
                        $node->process($source->results($options), $options);
                    }
                } else {
                    $node->process([], $options);
                }
            }
        }
    }
}