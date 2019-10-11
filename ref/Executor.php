<?php

namespace app\extensions\flow;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerInterface;

final class Executor implements LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @var ProcessorInterface[]
     */
    private $processors = [];

    /**
     * @param LoggerInterface|null $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        $this->logger = $logger;
    }

    /**
     * @inheritDoc
     */
    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;

        foreach ($this->processors as $processor) {
            if ($processor instanceof LoggerAwareInterface) {
                $processor->setLogger($this->logger);
            }
        }
    }

    /**
     * @param ProcessorInterface $processor
     */
    public function addProcessor(ProcessorInterface $processor): void
    {
        if ($this->logger && $processor instanceof LoggerAwareInterface) {
            $processor->setLogger($this->logger);
        }

        $this->processors[] = $processor;
    }

    /**
     * @param FlowInterface $flow
     *
     * @return int
     */
    public function execute(FlowInterface $flow): int
    {
        $progress = 0;

        foreach ($flow->getBlocks() as $block) {
            if (count($processors = $this->resolveProcessors($block))) {
                foreach ($processors as $processor) {
                    $progress += $processor->execute($flow, $block);
                }
            }
        }

        return $progress;
    }

    /**
     * @param FlowInterface $flow
     *
     * @return array Errors array in format: [<blockID> => string[]]
     */
    public function validate(FlowInterface $flow): array
    {
        $result = [];

        foreach ($flow->getBlocks() as $block) {
            if (count($processors = $this->resolveProcessors($block))) {
                $errors = [];

                foreach ($processors as $processor) {
                    if (count($messages = $processor->validate($flow, $block))) {
                        array_push($errors, ...$messages);
                    }
                }

                if (!empty($errors)) {
                    $result["[{$block->getID()}] {$block->getType()}"] = $errors;
                }
            }
        }

        return $result;
    }

    /**
     * @param BlockInterface $block
     *
     * @return ProcessorInterface[]
     */
    private function resolveProcessors(BlockInterface $block): array
    {
        $processors = [];

        foreach ($this->processors as $processor) {
            if ($processor->supports($block)) {
                $processors[] = $processor;
            }
        }

        uasort($processors, function (ProcessorInterface $a, ProcessorInterface $b) {
            return $b->getPriority() <=> $a->getPriority();
        });

        return $processors;
    }
}
