<?php

namespace PETest\Component\Flow\Definition;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\FlowValidator;
use PE\Component\Flow\Definition\NodeInterface;
use PE\Component\Flow\Definition\NodeValidatorInterface;
use PHPUnit\Framework\TestCase;

class FlowValidatorTest extends TestCase
{
    public function testSetValidatorsFailure(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $flowValidator = new FlowValidator();
        $flowValidator->setNodeValidators([null]);
    }

    public function testSetValidatorsSuccess(): void
    {
        $nodeValidator = $this->createMock(NodeValidatorInterface::class);

        $flowValidator = new FlowValidator();
        $flowValidator->setNodeValidators([$nodeValidator]);

        static::assertSame([$nodeValidator], $flowValidator->getNodeValidators());
    }

    public function testValidateWithoutValidators(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $flowValidator = new FlowValidator();

        static::assertSame([], $flowValidator->validate($flow));
    }

    public function testValidateWithValidatorsNotSupportsNode(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::once())->method('supports')->willReturn(false);
        $nodeValidator->expects(static::never())->method('validate');

        $flowValidator = new FlowValidator([$nodeValidator]);

        static::assertSame([], $flowValidator->validate($flow));
    }

    public function testValidateWithValidatorsSupportsNodeButValid(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::once())->method('supports')->willReturn(true);
        $nodeValidator->expects(static::once())->method('validate')->with($flow, $node)->willReturn([]);

        $flowValidator = new FlowValidator([$nodeValidator]);

        static::assertSame([], $flowValidator->validate($flow));
    }

    public function testValidateWithValidatorsSupportsNodeButInvalid(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::once())->method('supports')->willReturn(true);
        $nodeValidator->expects(static::once())->method('validate')->with($flow, $node)->willReturn(['AAA']);

        $flowValidator = new FlowValidator([$nodeValidator]);

        static::assertSame([[$node, ['AAA']]], $flowValidator->validate($flow));
    }
}
