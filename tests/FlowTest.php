<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Flow;
use PE\Component\Flow\Line;
use PE\Component\Flow\Node;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testAddNodeThrowExceptionIfDuplicate(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A', function(){}));
        $flow->addNode(new Node('A', function(){}));
    }

    public function testAddLineThrowExceptionIfNoSource(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('B', function(){}));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfNoTarget(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A', function(){}));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfDuplicate(): void
    {
        $this->expectException(\LogicException::class);

        $flow = new Flow();
        $flow->addNode(new Node('A', function(){}));
        $flow->addNode(new Node('B', function(){}));
        $flow->addLine(new Line('A', 'B'));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfNoAllowedSources(): void
    {
        $this->expectException(\LogicException::class);

        /* @var $mock Node|MockObject */
        $mock = $this->createMock(Node::class);
        $mock->method('getAllowedSourcesCount')->willReturn(0);
        $mock->method('getAllowedTargetsCount')->willReturn(PHP_INT_MAX);

        $flow = new Flow();
        $flow->addNode(new Node('A', function(){}));
        $flow->addNode($mock);
        $flow->addLine(new Line('A', 'B'));
    }

    public function testAddLineThrowExceptionIfNoAllowedTargets(): void
    {
        $this->expectException(\LogicException::class);

        /* @var $mock Node|MockObject */
        $mock = $this->createMock(Node::class);
        $mock->method('getAllowedSourcesCount')->willReturn(PHP_INT_MAX);
        $mock->method('getAllowedTargetsCount')->willReturn(0);

        $flow = new Flow();
        $flow->addNode($mock);
        $flow->addNode(new Node('B', function(){}));
        $flow->addLine(new Line('A', 'B'));
    }

    public function testGetNodes(): void
    {
        $flow = new Flow([$a = new Node('A', function(){}), $b = new Node('B', function(){})]);

        static::assertSame(['A' => $a, 'B' => $b], $flow->getNodes());
    }

    public function testGetNodeThrowExceptionIfNotExistsNode(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $flow = new Flow([new Node('A', function(){})]);
        $flow->getNode('B');
    }

    public function testGetNode(): void
    {
        $flow = new Flow([$a = new Node('A', function(){})]);

        static::assertSame($a, $flow->getNode('A'));
    }

    public function testGetLines(): void
    {
        $flow = new Flow([new Node('A', function(){}), new Node('B', function(){})], [$ab = new Line('A', 'B'), $ba = new Line('B', 'A')]);

        static::assertSame(['A-->B' => $ab, 'B-->A' => $ba], $flow->getLines());
    }

    public function testGetSourcesOf(): void
    {
        $flow = new Flow([$a = new Node('A', function(){}), $b = new Node('B', function(){})], [new Line('A', 'B')]);

        static::assertSame([$a], $flow->getSourceNodes($b));
    }

    public function testGetTargetsOf(): void
    {
        $flow = new Flow([$a = new Node('A', function(){}), $b = new Node('B', function(){})], [new Line('A', 'B')]);

        static::assertSame([$b], $flow->getTargetNodes($a));
    }
}
