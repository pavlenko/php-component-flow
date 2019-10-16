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
         * A     D
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

        $nodeE = new Node('E');
        $nodeE->setPorts([new Port('EI', Port::TYPE_I), new Port('EO', Port::TYPE_O)]);

        $link1 = new Link('1');
        $link1->setSourceBlockID('A');
        $link1->setSourcePortID('AO');
        $link1->setTargetBlockID('B');
        $link1->setTargetPortID('BI');

        $link2 = new Link('2');
        $link2->setSourceBlockID('B');
        $link2->setSourcePortID('BO');
        $link2->setTargetBlockID('C');
        $link2->setTargetPortID('CI');

        $link3 = new Link('3');
        $link3->setSourceBlockID('C');
        $link3->setSourcePortID('CO');
        $link3->setTargetBlockID('D');
        $link3->setTargetPortID('DI');

        $link4 = new Link('4');
        $link4->setSourceBlockID('A');
        $link4->setSourcePortID('AO');
        $link4->setTargetBlockID('E');
        $link4->setTargetPortID('EI');

        $link5 = new Link('4');
        $link5->setSourceBlockID('E');
        $link5->setSourcePortID('EO');
        $link5->setTargetBlockID('D');
        $link5->setTargetPortID('DI');

        $actual   = [$nodeC, $nodeA, $nodeB, $nodeE, $nodeD];
        $expected = [$nodeA, $nodeB, $nodeE, $nodeC, $nodeD];

        $flow = new Flow('FLOW');
        $flow->setNodes($actual);
        $flow->setLinks([$link1, $link2, $link3, $link4, $link5]);

        $sorter = new Sorter();
        $sorter->sort($flow);

        $this->markTestIncomplete();
        self::assertSame($expected, $flow->getNodes());
    }
}
