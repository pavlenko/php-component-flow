<?php

namespace PETest\Component\Flow\Definition;

use PE\Component\Flow\Definition\Node;
use PE\Component\Flow\Definition\PortInterface;
use PHPUnit\Framework\TestCase;

class NodeTest extends TestCase
{
    public function testInsertNode(): void
    {
        $port = $this->createMock(PortInterface::class);

        $node = new Node('N');
        $node->insertPort($port);
        $node->insertPort($port);

        self::assertSame([$port], $node->getPorts());
    }

    public function testRemoveNode(): void
    {
        $port = $this->createMock(PortInterface::class);

        $node = new Node('N');
        $node->insertPort($port);

        self::assertSame([$port], $node->getPorts());

        $node->removePort($port);

        self::assertSame([], $node->getPorts());
    }

    public function testSearchNode(): void
    {
        $port = $this->createMock(PortInterface::class);
        $port->expects(self::once())->method('getID')->willReturn('A');

        $node = new Node('N');

        self::assertNull($node->searchPort('A'));

        $node->insertPort($port);

        self::assertSame($port, $node->searchPort('A'));
    }

    public function testSetNodes(): void
    {
        $port1 = $this->createMock(PortInterface::class);
        $port2 = $this->createMock(PortInterface::class);

        $node = new Node('N');

        $node->setPorts([$port1]);

        self::assertSame([$port1], $node->getPorts());

        $node->setPorts([$port2]);

        self::assertSame([$port2], $node->getPorts());
    }

    public function testGetPorts(): void
    {
        $port = $this->createMock(PortInterface::class);
        $port->expects(self::any())->method('getType')->willReturn('I');

        $node = new Node('N');
        $node->setPorts([$port]);

        self::assertSame([], $node->getPorts('O'));
        self::assertSame([$port], $node->getPorts('I'));
    }
}
