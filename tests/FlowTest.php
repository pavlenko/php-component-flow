<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Flow;
use PE\Component\Flow\Line;
use PE\Component\Flow\Node;
use PETest\Component\Flow\Fixtures\ConfigurableNode;
use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testAddNodeThrowExceptionIfDuplicate(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A'));
        $flow->addNode(new Node('A'));
    }

    public function testAddLineThrowExceptionIfNoSource(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('B'));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfNoTarget(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A'));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfDuplicate(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A'));
        $flow->addNode(new Node('B'));
        $flow->addLine(new Line('A', 'B'));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfNoAllowedSources(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A'));
        $flow->addNode(new ConfigurableNode('B', 0, PHP_INT_MAX));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfNoAllowedTargets(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new ConfigurableNode('A', PHP_INT_MAX, 0));
        $flow->addNode(new Node('B'));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testGetNodes(): void
    {
        $flow = new Flow([$a = new Node('A'), $b = new Node('B')]);

        static::assertSame(['A' => $a, 'B' => $b], $flow->getNodes());
    }

    public function testGetNodeThrowExceptionIfNotExistsNode(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $flow = new Flow([new Node('A')]);
        $flow->getNode('B');
    }

    public function testGetNode(): void
    {
        $flow = new Flow([$a = new Node('A')]);

        static::assertSame($a, $flow->getNode('A'));
    }

    public function testGetLines(): void
    {
        $flow = new Flow([new Node('A'), new Node('B')], [$ab = new Line('A', 'B'), $ba = new Line('B', 'A')]);

        static::assertSame(['A-->B' => $ab, 'B-->A' => $ba], $flow->getLines());
    }

    public function testGetSourcesOf(): void
    {
        $flow = new Flow([$a = new Node('A'), $b = new Node('B')], [new Line('A', 'B')]);

        static::assertSame([$a], $flow->getSourcesOf($b));
    }

    public function testGetTargetsOf(): void
    {
        $flow = new Flow([$a = new Node('A'), $b = new Node('B')], [new Line('A', 'B')]);

        static::assertSame([$b], $flow->getTargetsOf($a));
    }
}
