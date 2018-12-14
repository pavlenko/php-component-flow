<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Flow;
use PE\Component\Flow\Line;
use PE\Component\Flow\Node;
use PHPUnit\Framework\TestCase;

class FlowTest extends TestCase
{
    public function testGetSourcesOf(): void
    {
        $flow = new Flow(
            'FLOW',
            [$a = new Node('A'), $b = new Node('B')],
            [new Line('L', 'A', 'B')]
        );

        static::assertSame([$a], $flow->getSourcesOf($b));
    }

    public function testGetTargetsOf(): void
    {
        $flow = new Flow(
            'FLOW',
            [$a = new Node('A'), $b = new Node('B')],
            [new Line('L', 'A', 'B')]
        );

        static::assertSame([$b], $flow->getTargetsOf($a));
    }
}
