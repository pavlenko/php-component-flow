<?php

namespace PETest\Component\Flow;

use PE\Component\Flow\Subject;
use PE\Component\Flow\SubjectCollection;
use PHPUnit\Framework\TestCase;

class SubjectCollectionTest extends TestCase
{
    public function testConstructThrowExceptionOnInvalidArgument(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        new SubjectCollection(['FOO']);
    }

    public function testIteration(): void
    {
        $collection = new SubjectCollection($expected = ['A' => new Subject('B'), 'C' => new Subject('D')]);

        foreach ($collection as $key => $value) {
            static::assertArrayHasKey($key, $expected);
            static::assertSame($expected[$key], $value);
        }
    }
}
