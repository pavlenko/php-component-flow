<?php

namespace PE\Flow\Tests\Validation;

use PE\Flow\Definition\Node;
use PE\Flow\Definition\NodeInterface;
use PE\Flow\Definition\Flow;
use PE\Flow\Definition\FlowInterface;
use PE\Flow\Definition\Link;
use PE\Flow\Definition\Port;
use PE\Flow\Definition\PortInterface;
use PE\Flow\Validation\ConstraintInterface;
use PE\Flow\Validation\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    private function createFlow(bool $withBlocks = false, bool $withPorts = false, bool $withLinks = false): Flow
    {
        $flow = new Flow('flow');
        if ($withBlocks) {
            $flow->addNode(new Node('block1', 'test'));
            $flow->addNode(new Node('block2', 'test'));
        }
        if ($withPorts) {
            $flow->addPort(new Port('port1', PortInterface::TYPE_O, 'block1'));
            $flow->addPort(new Port('port2', PortInterface::TYPE_I, 'block2'));
        }
        if ($withLinks) {
            $flow->addLink(new Link('link', 'port1', 'port2'));
        }
        return $flow;
    }

    public function testEmptyFlow()
    {
        $flow      = $this->createFlow();
        $validator = new Validator();
        $validator->validate($flow, $messages);

        self::assertCount(1, $messages);
    }

    public function testFlowBlockWithoutPorts()
    {
        $flow      = $this->createFlow(true);
        $validator = new Validator();
        $validator->validate($flow, $messages);

        self::assertCount(2, $messages);
    }

    public function testFlowPortsUnconnected()
    {
        $flow      = $this->createFlow(true, true);
        $validator = new Validator();
        $validator->validate($flow, $messages);

        self::assertCount(2, $messages);
    }

    public function testFlowConfigured()
    {
        $flow      = $this->createFlow(true, true, true);
        $validator = new Validator();
        $validator->validate($flow, $messages);

        self::assertCount(0, $messages);
    }

    public function testFlowWithConstraint()
    {
        $constraint = $this->createMock(ConstraintInterface::class);
        $constraint
            ->expects(self::exactly(2))
            ->method('validate')
            ->with(
                self::isInstanceOf(NodeInterface::class),
                self::isInstanceOf(FlowInterface::class),
                self::isType('array')
            );

        $flow      = $this->createFlow(true, true, true);
        $validator = new Validator([$constraint]);
        $validator->validate($flow, $messages);

        self::assertCount(0, $messages);
    }
}
