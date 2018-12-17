<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Executor;
use PE\Component\Flow\Flow;
use PE\Component\Flow\Node;
use PE\Component\Flow\NodeInterface;
use PE\Component\Flow\Subject;
use PE\Component\Flow\SubjectCollection;
use PE\Component\Flow\SubjectProviderInterface;
use PETest\Component\Flow\Fixtures\SubjectProviderNode;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ExecutorTest extends TestCase
{
    public function testExecuteNode(): void
    {
        /* @var $provider MockObject|SubjectProviderInterface */
        $provider = $this->createMock(SubjectProviderInterface::class);

        $executed = false;
        $callable = function () use (&$executed) {
            $executed = true;
        };

        $node = new Node('A', $callable);

        $executor = new Executor($provider);
        $executor->executeNode($node);

        static::assertTrue($executed);
    }

    public function testExecuteFlow(): void
    {
        $subject = new Subject();

        /* @var $provider MockObject|SubjectProviderInterface */
        $provider = $this->createMock(SubjectProviderInterface::class);
        $provider->method('getSubjectCollection')->willReturn(new SubjectCollection([$subject]));

        $executed1 = false;
        $callable1 = function (NodeInterface $node, SubjectCollection $collection) use (&$executed1) {
            $collection->setState('B');
            $executed1 = true;
        };

        $executed2 = false;
        $callable2 = function () use (&$executed2) {
            $executed2 = true;
        };

        $flow = new Flow([new Node('A', $callable1), new SubjectProviderNode('B', $callable2)]);

        $executor = new Executor($provider);
        $executor->executeFlow($flow);

        static::assertTrue($executed1);
        static::assertTrue($executed2);

        static::assertSame('B', $subject->getState());
    }
}
