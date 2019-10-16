<?php

namespace PE\Component\Flow\Util;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\NodeInterface;

class Sorter
{
    public function sort(FlowInterface $flow)
    {
        $nodes    = [];
        $priority = [];

        // Create initial priority
        foreach ($flow->getNodes() as $node) {
            $nodes[$node->getID()]    = $node;
            $priority[$node->getID()] = 0;
        }

        // Increment by dependencies
        foreach ($nodes as $node) {
            $targets = $this->findNodeTargetNodesRecursive($flow, $node);

            foreach ($targets as $target) {
                $priority[$target->getID()]++;
            }
        }

        array_multisort($priority, SORT_ASC, $nodes);

        $flow->setNodes($nodes);
    }

    /**
     * @param FlowInterface $flow
     * @param NodeInterface $node
     *
     * @return NodeInterface[]
     */
    private function findNodeTargetNodesRecursive(FlowInterface $flow, NodeInterface $node): array
    {
        //TODO check has target -> sub-target nodes before call recursion
        $result  = [];
        $targets = Finder::findNodeTargetNodes($flow, $node);

        foreach ($targets as $target) {
            $result[] = $target;

            $result = array_merge($result, $this->findNodeTargetNodesRecursive($flow, $target));
        }

        return $result;
    }
}
