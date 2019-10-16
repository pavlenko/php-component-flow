<?php

namespace PETest\Component\Flow\Util;

use PE\Component\Flow\Definition\Flow;
use PE\Component\Flow\Definition\Link;
use PE\Component\Flow\Definition\Node;
use PE\Component\Flow\Definition\Port;
use PE\Component\Flow\Util\Sorter;
use PHPUnit\Framework\TestCase;

class SorterTest extends TestCase
{
    public function testSort(): void
    {
        /**
         *   B-C
         *  /   \
         * A-B-C-D
         *  \   /
         *    E
         *
         * Expected order: A B E C D
         */

        $nodeA = new Node('A');
        $nodeA->setPorts([new Port('AO', Port::TYPE_O)]);

        $nodeB = new Node('B');
        $nodeB->setPorts([new Port('BI', Port::TYPE_I), new Port('BO', Port::TYPE_O)]);

        $nodeC = new Node('C');
        $nodeC->setPorts([new Port('CI', Port::TYPE_I), new Port('CO', Port::TYPE_O)]);

        $nodeD = new Node('D');
        $nodeD->setPorts([new Port('DI', Port::TYPE_I)]);

        $link1 = new Link('1');
        $link1->setSourceNodeID('A');
        $link1->setSourcePortID('AO');
        $link1->setTargetNodeID('B');
        $link1->setTargetPortID('BI');

        $link2 = new Link('2');
        $link2->setSourceNodeID('B');
        $link2->setSourcePortID('BO');
        $link2->setTargetNodeID('C');
        $link2->setTargetPortID('CI');

        $link3 = new Link('3');
        $link3->setSourceNodeID('C');
        $link3->setSourcePortID('CO');
        $link3->setTargetNodeID('D');
        $link3->setTargetPortID('DI');

        $actual   = [$nodeC, $nodeA, $nodeB, $nodeD];
        $expected = [$nodeA, $nodeB, $nodeC, $nodeD];

        $flow = new Flow('FLOW');
        $flow->setNodes($actual);
        $flow->setLinks([$link1, $link2, $link3]);

        $sorter = new Sorter();
        $sorter->sort($flow);

        //$this->markTestIncomplete();
        self::assertSame($expected, $flow->getNodes());
    }
}
