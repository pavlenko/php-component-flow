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
    public function execute(array &$options = [], string $nodeID = null)
    {
        foreach ($this->flow->getNodes() as $node) {
            if (null === $nodeID || $node->getID() == $nodeID) {
                $sources = $this->flow->getSourcesOf($node);
                $results = [];

                foreach ($sources as $source) {
                    foreach ($source->results($options) as $result) {
                        $results[] = $result;
                    }
                }

                $node->process($results, $options);
            }
        }
    }
}