<?php

namespace PE\Flow\Tests\Definition;

use PE\Flow\Definition\Node;
use PE\Flow\Definition\Flow;
use PE\Flow\Definition\Link;
use PE\Flow\Definition\Port;
use PE\Flow\Definition\PortInterface;
use PHPUnit\Framework\TestCase;

final class FlowTest extends TestCase
{
    public function testAddBlockErrorIfDuplicateId(): void
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addNode(new Node('block', 'test'));
        $flow->addNode(new Node('block', 'test'));
    }

    public function testAddPortErrorIfDuplicateId(): void
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addNode(new Node('block', 'test'));
        $flow->addPort(new Port('port', PortInterface::TYPE_I, 'block'));
        $flow->addPort(new Port('port', PortInterface::TYPE_I, 'block'));
    }

    public function testAddPortErrorIfBlockNotExists(): void
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addPort(new Port('port', PortInterface::TYPE_I, 'unknown'));
    }

    public function testAddLinkErrorIfDuplicateId()
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addNode(new Node('block1', 'test'));
        $flow->addNode(new Node('block2', 'test'));
        $flow->addPort(new Port('port1', PortInterface::TYPE_O, 'block1'));
        $flow->addPort(new Port('port2', PortInterface::TYPE_I, 'block2'));
        $flow->addLink(new Link('test', 'port1', 'port2'));
        $flow->addLink(new Link('test', 'port1', 'port2'));
    }

    public function testAddLinkErrorIfSourcePortNotFound()
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addLink(new Link('test', '1', '2'));
    }

    public function testAddLinkErrorIfTargetPortNotFound()
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addNode(new Node('block1', 'test'));
        $flow->addPort(new Port('1', PortInterface::TYPE_O, 'block1'));
        $flow->addLink(new Link('test', '1', '2'));
    }

    public function testAddLinkErrorIfDuplicateConfig()
    {
        $this->expectException(\RuntimeException::class);

        $flow = new Flow('flow');
        $flow->addNode(new Node('block1', 'test'));
        $flow->addNode(new Node('block2', 'test'));
        $flow->addPort(new Port('port1', PortInterface::TYPE_O, 'block1'));
        $flow->addPort(new Port('port2', PortInterface::TYPE_I, 'block2'));
        $flow->addLink(new Link('link1', 'port1', 'port2'));
        $flow->addLink(new Link('link2', 'port1', 'port2'));
    }

    public function testBlocks()
    {
        $block1 = new Node('block1', 'test1');
        $block2 = new Node('block2', 'test2');

        $flow = new Flow('flow');
        $flow->setNodes([$block1, $block2]);

        self::assertEquals(['block1' => $block1, 'block2' => $block2], $flow->getNodes());
        self::assertSame($block1, $flow->getNode('block1'));
        self::assertSame($block2, $flow->getNode('block2'));
        self::assertSame('test1', $flow->getNode('block1')->getType());
        self::assertSame('test2', $flow->getNode('block2')->getType());
        self::assertNull($flow->getNode('block3'));

        $flow->delNode('block2');

        self::assertNull($flow->getNode('block2'));
    }

    public function testNewPortErrorIfTypeInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Port('port', 'invalid', 'block');
    }

    public function testPorts()
    {
        $port = new Port('port', PortInterface::TYPE_I, 'block');
        $flow = new Flow('flow');
        $flow->addNode($block = new Node('block', 'test'));
        $flow->setPorts([$port]);

        self::assertEquals(['port' => $port], $flow->getPorts());
        self::assertEquals(['port' => $port], $flow->getPorts('block'));
        self::assertEquals(['port' => $port], $block->getPorts($flow, PortInterface::TYPE_I));
        self::assertEmpty($flow->getPorts('block2'));
        self::assertSame($port, $flow->getPort('port'));
        self::assertSame(PortInterface::TYPE_I, $port->getType());
        self::assertNull($flow->getPort('port2'));

        $flow->delPort('port');

        self::assertNull($flow->getPort('port'));
        self::assertSame($block, $port->getNode($flow));
        self::assertEquals([], $block->getPorts($flow));

        $port = new Port('port', PortInterface::TYPE_I, 'unknown');
        self::assertNull($port->getNode($flow));
    }

    public function testNewLinkErrorIfPortsAreSame()
    {
        $this->expectException(\InvalidArgumentException::class);
        new Link('link', 'port', 'port');
    }

    public function testLinks()
    {
        $link = new Link('link', 'port1', 'port2');
        $flow = new Flow('flow');
        $flow->addNode(new Node('block1', 'test'));
        $flow->addNode(new Node('block2', 'test'));
        $flow->addPort($port1 = new Port('port1', PortInterface::TYPE_O, 'block1'));
        $flow->addPort($port2 = new Port('port2', PortInterface::TYPE_I, 'block2'));
        $flow->setLinks([$link]);

        self::assertEquals(['link' => $link], $flow->getLinks());
        self::assertSame($link, $flow->getLink('link'));
        self::assertNull($flow->getLink('unknown'));

        $flow->delLink('link');

        self::assertNull($flow->getLink('link'));

        self::assertSame($port1, $link->getSourcePort($flow));
        self::assertSame($port2, $link->getTargetPort($flow));

        $link = new Link('link', 'port3', 'port4');

        self::assertNull($link->getSourcePort($flow));
        self::assertNull($link->getTargetPort($flow));
    }

    public function testMeta()
    {
        $meta = ['foo' => 'bar'];
        $flow = new Flow('flow', $meta);

        self::assertSame($meta, $flow->getMetaData());

        self::assertTrue($flow->hasMetaItem('foo'));
        self::assertSame('bar', $flow->getMetaItem('foo'));

        self::assertFalse($flow->hasMetaItem('baz'));
        self::assertNull($flow->getMetaItem('baz'));
        self::assertSame('def', $flow->getMetaItem('baz', 'def'));
    }

    public function testData()
    {
        $data  = ['foo' => 'bar'];
        $block = new Node('block', 'type');
        $block->setData($data);

        self::assertSame($data, $block->getData());

        self::assertTrue($block->hasDataItem('foo'));
        self::assertSame('bar', $block->getDataItem('foo'));

        self::assertFalse($block->hasDataItem('baz'));
        self::assertNull($block->getDataItem('baz'));
        self::assertSame('def', $block->getDataItem('baz', 'def'));

        $block->setDataItem('test', 'some');

        self::assertTrue($block->hasDataItem('test'));
        self::assertSame('some', $block->getDataItem('test'));

        $block->delDataItem('test');

        self::assertFalse($block->hasDataItem('test'));
    }
}
