<?php

namespace app\extensions\flow;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;
use Psr\Log\LogLevel;

abstract class Processor implements ProcessorInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    /**
     * @param FlowInterface  $flow
     * @param BlockInterface $block
     * @param string         $message
     * @param string         $level
     */
    protected function log(FlowInterface $flow, BlockInterface $block, string $message, string $level = LogLevel::DEBUG)
    {
        $prefix = sprintf(
            '%s FLOW(%s)->%s(%s)',
            date('Y-m-d H:i:s'),
            $flow->getID(),
            $block->getType(),
            $block->getID()
        );

        $this->logger && $this->logger->log($level, "{$prefix}: {$message}");
    }

    /**
     * @param array $weights In format [<key> => <weight>]
     *
     * @return int|string
     */
    protected function resolveRandomKey(array $weights)
    {
        $rand = mt_rand(1, (int) array_sum($weights));
        $sum  = 0;

        foreach ($weights as $key => $value) {
            $sum += $value;

            if ($sum >= $rand) {
                return $key;
            }
        }

        end($weights);
        return key($weights);
    }

    /**
     * @inheritDoc
     */
    public function getPriority(): int
    {
        return 0;
    }

    /**
     * @inheritDoc
     */
    public function execute(FlowInterface $flow, BlockInterface $block): int
    {}

    /**
     * @inheritDoc
     */
    public function validate(FlowInterface $flow, BlockInterface $block): array
    {
        return [];
    }
}
