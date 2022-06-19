<?php

namespace PE\Flow\Tests\Processing;

use PE\Flow\Definition\Node;
use PE\Flow\Definition\Flow;
use PE\Flow\Processing\Executor;
use PE\Flow\Processing\ProcessorInterface;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

class ExecutorTest extends TestCase
{
    public function testExecute1()
    {
        $flow = new Flow('flow');
        $flow->addNode(new Node('block', 'foo'));

        $processor = $this->getMockForAbstractClass(ProcessorStub::class);
        $processor->expects(self::never())->method('getPriority');
        $processor->expects(self::once())->method('support')->willReturn(false);
        $processor->expects(self::never())->method('execute');

        $executor = new Executor([$processor]);
        $executor->execute($flow);
    }

    public function testExecute2()
    {
        $flow = new Flow('flow');
        $flow->addNode(new Node('block1', 'foo'));
        $flow->addNode(new Node('block2', 'foo'));

        $processor = $this->getMockForAbstractClass(ProcessorStub::class);
        $processor->expects(self::never())->method('getPriority');
        $processor->expects(self::exactly(2))->method('support')->willReturn(true);
        $processor->expects(self::exactly(2))->method('execute');

        $executor = new Executor([$processor]);
        $executor->execute($flow);
    }

    public function testExecute3()
    {
        $flow = new Flow('flow');
        $flow->addNode(new Node('block1', 'foo'));
        $flow->addNode(new Node('block2', 'foo'));

        $processor1 = $this->getMockForAbstractClass(ProcessorStub::class);
        $processor1->expects(self::exactly(2))->method('getPriority');
        $processor1->expects(self::exactly(2))->method('support')->willReturn(true);
        $processor1->expects(self::exactly(2))->method('execute');

        $processor2 = $this->getMockForAbstractClass(ProcessorStub::class);
        $processor2->expects(self::exactly(2))->method('getPriority');
        $processor2->expects(self::exactly(2))->method('support')->willReturn(true);
        $processor2->expects(self::exactly(2))->method('execute');

        $executor = new Executor([$processor1, $processor2]);
        $executor->execute($flow);
    }
}

abstract class ProcessorStub implements ProcessorInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;
}
