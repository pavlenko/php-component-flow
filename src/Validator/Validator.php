<?php

namespace PE\Component\Flow\Validator;

use PE\Component\Flow\Definition\FlowInterface;

final class Validator implements ValidatorInterface
{
    /**
     * @var FlowValidatorInterface[]
     */
    private $flowValidators = [];

    /**
     * @var NodeValidatorInterface[]
     */
    private $nodeValidators = [];

    /**
     * @param FlowValidatorInterface[] $flowValidators
     * @param NodeValidatorInterface[] $nodeValidators
     */
    public function __construct(array $flowValidators = [], array $nodeValidators = [])
    {
        $this->setFlowValidators($flowValidators);
        $this->setNodeValidators($nodeValidators);
    }

    /**
     * @return FlowValidatorInterface[]
     */
    public function getFlowValidators(): array
    {
        return $this->flowValidators;
    }

    /**
     * @param FlowValidatorInterface[] $validators
     */
    public function setFlowValidators(array $validators): void
    {
        $this->flowValidators = [];

        foreach ($validators as $validator) {
            if (!($validator instanceof FlowValidatorInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Flow validator must be instance of %s, but got %s',
                    FlowValidatorInterface::class,
                    is_object($validator) ? get_class($validator) : gettype($validator)
                ));
            }

            $this->flowValidators[] = $validator;
        }
    }

    /**
     * @return NodeValidatorInterface[]
     */
    public function getNodeValidators(): array
    {
        return $this->nodeValidators;
    }

    /**
     * @param NodeValidatorInterface[] $validators
     */
    public function setNodeValidators(array $validators): void
    {
        $this->nodeValidators = [];

        foreach ($validators as $validator) {
            if (!($validator instanceof NodeValidatorInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Node validator must be instance of %s, but got %s',
                    NodeValidatorInterface::class,
                    is_object($validator) ? get_class($validator) : gettype($validator)
                ));
            }

            $this->nodeValidators[] = $validator;
        }
    }

    /**
     * @inheritDoc
     */
    public function validate(FlowInterface $flow): array
    {
        $result = [];

        foreach ($this->flowValidators as $flowValidator) {
            if (count($messages = $flowValidator->validate($flow))) {
                $result[] = [$flow, $messages];
            }
        }

        foreach ($flow->getNodes() as $node) {
            $errors = [];

            foreach ($this->nodeValidators as $nodeValidator) {
                if ($nodeValidator->supports($node) && count($messages = $nodeValidator->validate($flow, $node))) {
                    array_push($errors, ...$messages);
                }
            }

            if ($errors) {
                $result[] = [$node, $errors];
            }
        }

        return $result;
    }
}
