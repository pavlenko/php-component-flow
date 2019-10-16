<?php

namespace PETest\Component\Flow\Validator;

use PE\Component\Flow\Definition\FlowInterface;
use PE\Component\Flow\Definition\NodeInterface;
use PE\Component\Flow\Validator\FlowValidatorInterface;
use PE\Component\Flow\Validator\NodeValidatorInterface;
use PE\Component\Flow\Validator\Validator;
use PHPUnit\Framework\TestCase;

class ValidatorTest extends TestCase
{
    public function testSetFlowValidatorsFailure(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $validator = new Validator();
        $validator->setFlowValidators([null]);
    }

    public function testSetFlowValidatorsSuccess(): void
    {
        $flowValidator = $this->createMock(FlowValidatorInterface::class);

        $validator = new Validator();
        $validator->setFlowValidators([$flowValidator]);

        static::assertSame([$flowValidator], $validator->getFlowValidators());
    }

    public function testSetNodeValidatorsFailure(): void
    {
        $this->expectException(\UnexpectedValueException::class);

        $validator = new Validator();
        $validator->setNodeValidators([null]);
    }

    public function testSetNodeValidatorsSuccess(): void
    {
        $nodeValidator = $this->createMock(NodeValidatorInterface::class);

        $validator = new Validator();
        $validator->setNodeValidators([$nodeValidator]);

        static::assertSame([$nodeValidator], $validator->getNodeValidators());
    }

    public function testValidateWithoutAnyValidators(): void
    {
        $flow = $this->createMock(FlowInterface::class);

        $validator = new Validator();

        static::assertSame([], $validator->validate($flow));
    }

    public function testValidateWithFlowValidator(): void
    {
        $flow = $this->createMock(FlowInterface::class);

        $flowValidator = $this->createMock(FlowValidatorInterface::class);
        $flowValidator
            ->expects(self::once())
            ->method('validate')
            ->with($flow)
            ->willReturn(['ERROR']);

        $validator = new Validator();
        $validator->setFlowValidators([$flowValidator]);

        static::assertSame([[$flow, ['ERROR']]], $validator->validate($flow));
    }

    public function testValidateWithNodeValidatorAndEmptyFlow(): void
    {
        $flow = $this->createMock(FlowInterface::class);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::never())->method('supports');

        $validator = new Validator();
        $validator->setNodeValidators([$nodeValidator]);

        static::assertSame([], $validator->validate($flow));
    }

    public function testValidateWithNodeValidatorNotSupportsNode(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::once())->method('supports')->willReturn(false);
        $nodeValidator->expects(static::never())->method('validate');

        $validator = new Validator();
        $validator->setNodeValidators([$nodeValidator]);

        static::assertSame([], $validator->validate($flow));
    }

    public function testValidateWithNodeValidatorSupportsNodeAndValid(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::once())->method('supports')->willReturn(true);
        $nodeValidator->expects(static::once())->method('validate')->willReturn([]);

        $validator = new Validator();
        $validator->setNodeValidators([$nodeValidator]);

        static::assertSame([], $validator->validate($flow));
    }

    public function testValidateWithNodeValidatorSupportsNodeNotValid(): void
    {
        $node = $this->createMock(NodeInterface::class);
        $flow = $this->createMock(FlowInterface::class);
        $flow->expects(static::once())->method('getNodes')->willReturn([$node]);

        $nodeValidator = $this->createMock(NodeValidatorInterface::class);
        $nodeValidator->expects(static::once())->method('supports')->willReturn(true);
        $nodeValidator->expects(static::once())->method('validate')->willReturn(['ERROR']);

        $validator = new Validator();
        $validator->setNodeValidators([$nodeValidator]);

        static::assertSame([[$node, ['ERROR']]], $validator->validate($flow));
    }
}
