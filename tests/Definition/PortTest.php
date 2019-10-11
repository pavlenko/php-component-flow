<?php

namespace PETest\Component\Flow\Definition;

use PE\Component\Flow\Definition\Port;
use PHPUnit\Framework\TestCase;

class PortTest extends TestCase
{
    public function testSetTypeFailure(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $port = new Port('P');
        $port->setType('A');
    }

    public function testSetTypeSuccess(): void
    {
        $port = new Port('P');
        $port->setType('I');

        self::assertSame('I', $port->getType());
    }
}
