<?php

namespace PETest\Component\Flow\Processor;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\NodeInterface;
use PE\Component\Flow\Processor\FlowProcessor;
use PE\Component\Flow\Processor\NodeProcessorInterface;
use PHPUnit\Framework\TestCase;

class FlowProcessorTest extends TestCase
{
    public function testSetValidatorsFailure(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $flowProcessor = new FlowProcessor();
        $flowProcessor->setNodeProcessors([null]);
    }

    public function testSetValidatorsSuccess(): void
    {
        $nodeProcessor = $this->createMock(NodeProcessorInterface::class);

        $flowProcessor = new FlowProcessor();
        $flowProcessor->setNodeProcessors([$nodeProcessor]);

        static::assertSame([$nodeProcessor], $flowProcessor->getNodeProcessors());
    }

    public function testProcessWithoutProcessors(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $flowProcessor = new FlowProcessor();

        static::assertSame(0, $flowProcessor->process($flow));
    }

    public function testProcessWithProcessorsNotSupportsNode(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeProcessor = $this->createMock(NodeProcessorInterface::class);
        $nodeProcessor->expects(static::once())->method('supports')->willReturn(false);
        $nodeProcessor->expects(static::never())->method('process');

        $flowProcessor = new FlowProcessor([$nodeProcessor]);

        static::assertSame(0, $flowProcessor->process($flow));
    }

    public function testProcessWithProcessorsSupportsNode(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeProcessor = $this->createMock(NodeProcessorInterface::class);
        $nodeProcessor->expects(static::once())->method('supports')->willReturn(true);
        $nodeProcessor->expects(static::once())->method('process')->willReturn(5);

        $flowProcessor = new FlowProcessor([$nodeProcessor]);

        static::assertSame(5, $flowProcessor->process($flow));
    }
}
