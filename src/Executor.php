<?php

namespace PE\Component\Flow;

final class Executor
{
    /**
     * @var Flow
     */
    private $flow;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @param Flow $flow
     */
    public function __construct(Flow $flow)
    {
        $this->flow = $flow;
    }

    public function execute(): void
    {
        foreach ($this->flow->getNodes() as $node) {
            if (count($sources = $this->flow->getSourceLines($node))) {
                foreach ($sources as $source) {
                    $this->executeNode($node, $this->getDatasetForLine($source));
                }
            } else {
                // If node without sources (start node) - execute with empty dataset
                $this->executeNode($node, new Dataset());
            }
        }
    }

    /**
     * @param NodeInterface $node
     * @param Dataset       $dataset
     */
    private function executeNode(NodeInterface $node, Dataset $dataset)
    {
        if (count($targets = $this->flow->getTargetLines($node))) {
            foreach ($targets as $target) {
                $this->setDatasetForLine($target, $node->process($dataset));
            }
        } else {
            // If node without targets (finish node) - execute without save results dataset
            $node->process($dataset);
        }
    }

    /**
     * @param LineInterface $line
     *
     * @return Dataset
     */
    private function getDatasetForLine(LineInterface $line): Dataset
    {
        $key = $line->getSourceID() . '-->' . $line->getTargetID();

        return $this->data[$key] ?? new Dataset();
    }

    /**
     * @param LineInterface $line
     * @param Dataset       $dataset
     */
    private function setDatasetForLine(LineInterface $line, Dataset $dataset): void
    {
        $key = $line->getSourceID() . '-->' . $line->getTargetID();

        $this->data[$key] = $dataset;
    }
}