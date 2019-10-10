<?php

namespace PE\Component\Flow\Definition;

use Psr\Log\LoggerInterface;

class FlowProcessor implements FlowProcessorInterface
{
    /**
     * @var NodeProcessorInterface[]
     */
    private $processors = [];

    /**
     * @param NodeProcessorInterface[] $processors
     */
    public function __construct(array $processors = [])
    {
        $this->setNodeProcessors($processors);
    }

    /**
     * @return NodeProcessorInterface[]
     */
    public function getNodeProcessors(): array
    {
        return $this->processors;
    }

    /**
     * @param NodeProcessorInterface[] $processors
     */
    public function setNodeProcessors(array $processors): void
    {
        $this->processors = [];

        foreach ($processors as $processor) {
            if (!($processor instanceof NodeProcessorInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Processor must be instance of %s, but got %s',
                    NodeProcessorInterface::class,
                    is_object($processor) ? get_class($processor) : gettype($processor)
                ));
            }

            $this->processors[] = $processor;
        }
    }

    /**
     * @inheritDoc
     */
    public function process(FlowInterface $flow, LoggerInterface $logger = null): int
    {
        $progress = 0;

        foreach ($flow->getNodes() as $node) {
            foreach ($this->processors as $processor) {
                if ($processor->supports($node)) {
                    $progress += $processor->process($flow, $node, $logger);
                }
            }
        }

        return $progress;
    }
}
