<?php

namespace PETest\Component\Flow\Definition;

use PE\Component\Flow\Definition\MetadataInterface;
use PE\Component\Flow\Definition\MetadataTrait;
use PHPUnit\Framework\TestCase;

class MetadataTraitTest extends TestCase
{
    public function testGetSetMetadataItems(): void
    {
        $obj = new class implements MetadataInterface {
            use MetadataTrait;
        };

        $data = ['A' => 'B', 'C' => 'D'];

        $obj->setMetadata($data);

        self::assertSame($data, $obj->getMetadata());
    }

    public function testHasGetSetDelMetadataItem(): void
    {
        $obj = new class implements MetadataInterface {
            use MetadataTrait;
        };

        self::assertFalse($obj->hasMetadataItem('A'));
        self::assertSame(null, $obj->getMetadataItem('A'));
        self::assertSame('C', $obj->getMetadataItem('A', 'C'));

        $obj->setMetadataItem('A', 'B');

        self::assertTrue($obj->hasMetadataItem('A'));
        self::assertSame('B', $obj->getMetadataItem('A'));

        $obj->delMetadataItem('A');

        self::assertFalse($obj->hasMetadataItem('A'));
    }
}
