<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Flow;
use PE\Component\Flow\Line;
use PE\Component\Flow\Node;
use PE\Component\Flow\NodeInterface;
use PE\Component\Flow\Subject;
use PE\Component\Flow\SubjectCollection;
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

    public function testGetNodes()
    {
        $flow = new Flow([$a = new Node('A'), $b = new Node('B')]);

        static::assertSame(['A' => $a, 'B' => $b], $flow->getNodes());
    }

    public function testGetLines()
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

    public function testProcessWithExternalCollection(): void
    {
        $process = function (NodeInterface $node, SubjectCollection $subjects = null) {
            if ($subjects) {
                $subjects->setState($node->getID());
            }
        };

        $flow = new Flow([new Node('A', $process), new Node('B', $process)], [new Line('A', 'B')]);

        $flow->process(new SubjectCollection([$subject = new Subject('A')]));

        static::assertSame('B', $subject->getState());
    }

    public function testProcessWithInternalCollection(): void
    {
        $subject = new Subject('A');

        $process = function (NodeInterface $node, SubjectCollection $subjects = null) {
            if ($subjects) {
                $subjects->setState($node->getID());
            }
        };

        $getSubjectCollection = function () use ($subject) {
            return new SubjectCollection([$subject]);
        };

        $flow = new Flow([new Node('A', $process, $getSubjectCollection), new Node('B', $process)], [new Line('A', 'B')]);

        $flow->process();

        static::assertSame('B', $subject->getState());
    }
}
