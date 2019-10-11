<?php

namespace PETest\Component\Flow\Definition;

use PE\Component\Flow\Definition\Flow;
use PE\Component\Flow\Definition\LinkInterface;
use PE\Component\Flow\Definition\NodeInterface;
use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testInsertNode(): void
    {
        $node = $this->createMock(NodeInterface::class);

        $flow = new Flow('F');
        $flow->insertNode($node);
        $flow->insertNode($node);

        self::assertSame([$node], $flow->getNodes());
    }

    public function testRemoveNode(): void
    {
        $node = $this->createMock(NodeInterface::class);

        $flow = new Flow('F');
        $flow->insertNode($node);

        self::assertSame([$node], $flow->getNodes());

        $flow->removeNode($node);

        self::assertSame([], $flow->getNodes());
    }

    public function testSearchNode(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $node->expects(self::once())->method('getID')->willReturn('A');

        $flow = new Flow('F');

        self::assertNull($flow->searchNode('A'));

        $flow->insertNode($node);

        self::assertSame($node, $flow->searchNode('A'));
    }

    public function testSetNodes(): void
    {
        $node1 = $this->createMock(NodeInterface::class);
        $node2 = $this->createMock(NodeInterface::class);

        $flow = new Flow('F');

        $flow->setNodes([$node1]);

        self::assertSame([$node1], $flow->getNodes());

        $flow->setNodes([$node2]);

        self::assertSame([$node2], $flow->getNodes());
    }

    public function testInsertLink(): void
    {
        $link = $this->createMock(LinkInterface::class);

        $flow = new Flow('F');
        $flow->insertLink($link);
        $flow->insertLink($link);

        self::assertSame([$link], $flow->getLinks());
    }

    public function testRemoveLink(): void
    {
        $link = $this->createMock(LinkInterface::class);

        $flow = new Flow('F');
        $flow->insertLink($link);

        self::assertSame([$link], $flow->getLinks());

        $flow->removeLink($link);

        self::assertSame([], $flow->getLinks());
    }

    public function testSetLinks(): void
    {
        $link1 = $this->createMock(LinkInterface::class);
        $link2 = $this->createMock(LinkInterface::class);

        $flow = new Flow('F');

        $flow->setLinks([$link1]);

        self::assertSame([$link1], $flow->getLinks());

        $flow->setLinks([$link2]);

        self::assertSame([$link2], $flow->getLinks());
    }
}
