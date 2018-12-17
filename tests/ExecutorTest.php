<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Executor;
use PE\Component\Flow\Flow;
use PE\Component\Flow\Line;
use PE\Component\Flow\Node;
use PHPUnit\Framework\TestCase;

class ExecutorTest extends TestCase
{
    public function testExecuteFlow(): void
    {
        $executed1 = false;
        $callable1 = function () use (&$executed1) { $executed1 = true; };

        $executed2 = false;
        $callable2 = function () use (&$executed2) { $executed2 = true; };

        $executed3 = false;
        $callable3 = function () use (&$executed3) { $executed3 = true; };

        $node1 = new Node('A', $callable1, $callable2);
        $node2 = new Node('B', $callable3);

        $flow = new Flow([$node1, $node2], [new Line('A', 'B')]);

        $executor = new Executor($flow);
        $executor->execute();

        static::assertTrue($executed1);
        static::assertTrue($executed2);
        static::assertTrue($executed3);
    }

    public function testExecuteNode(): void
    {
        $executed1 = false;
        $callable1 = function () use (&$executed1) { $executed1 = true; };

        $executed2 = false;
        $callable2 = function () use (&$executed2) { $executed2 = true; };

        $executed3 = false;
        $callable3 = function () use (&$executed3) { $executed3 = true; };

        $node1 = new Node('A', $callable1, $callable2);
        $node2 = new Node('B', $callable3);

        $flow = new Flow([$node1, $node2], [new Line('A', 'B')]);

        $options = [];

        $executor = new Executor($flow);
        $executor->execute($options, 'B');

        static::assertFalse($executed1);
        static::assertTrue($executed2);
        static::assertTrue($executed3);
    }
}
