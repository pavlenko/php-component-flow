<?php

namespace PE\Flow\Processing;

use PE\Flow\Definition\NodeInterface;
use PE\Flow\Definition\FlowInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use Psr\Log\NullLogger;

final class Executor
{
    /**
     * @var ProcessorInterface[]
     */
    private array $processors = [];
    private LoggerInterface $logger;

    /**
     * @param ProcessorInterface[] $processors
     * @param LoggerInterface|null $logger
     */
    public function __construct(array $processors = [], LoggerInterface $logger = null)
    {
        $this->logger = $logger ?: new NullLogger();
        foreach ($processors as $processor) {
            $this->addProcessor($processor);
        }
    }

    public function addProcessor(ProcessorInterface $processor): self
    {
        $this->processors[spl_object_hash($processor)] = $processor;
        if ($processor instanceof LoggerAwareInterface) {
            $processor->setLogger($this->logger);
        }
        return $this;
    }

    /**
     * @param NodeInterface $node
     * @return ProcessorInterface[]
     */
    private function getProcessors(NodeInterface $node): array
    {
        $processors = [];
        foreach ($this->processors as $processor) {
            if ($processor->support($node)) {
                $processors[] = $processor;
            }
        }

        uasort($processors, static function (ProcessorInterface $a, ProcessorInterface $b) {
            return $b->getPriority() <=> $a->getPriority();
        });
        return $processors;
    }

    /**
     * @param FlowInterface $flow
     * @return void
     */
    public function execute(FlowInterface $flow): void
    {
        $this->logger->log(LogLevel::NOTICE, sprintf('Processing flow %s ...', $flow->getID()));

        foreach ($flow->getNodes() as $node) {
            foreach ($this->getProcessors($node) as $processor) {
                $processor->execute($node, $flow);
            }
        }

        $this->logger->log(LogLevel::NOTICE, sprintf('Processing flow %s DONE', $flow->getID()));
    }
}
