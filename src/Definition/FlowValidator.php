<?php

namespace PE\Component\Flow\Definition;

final class FlowValidator implements FlowValidatorInterface
{
    /**
     * @var NodeValidatorInterface[]
     */
    private $validators = [];

    /**
     * @param NodeValidatorInterface[] $validators
     */
    public function __construct(array $validators = [])
    {
        $this->setNodeValidators($validators);
    }

    /**
     * @return NodeValidatorInterface[]
     */
    public function getNodeValidators(): array
    {
        return $this->validators;
    }

    /**
     * @param NodeValidatorInterface[] $validators
     */
    public function setNodeValidators(array $validators): void
    {
        $this->validators = [];

        foreach ($validators as $validator) {
            if (!($validator instanceof NodeValidatorInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Validator must be instance of %s, but got %s',
                    NodeValidatorInterface::class,
                    is_object($validator) ? get_class($validator) : gettype($validator)
                ));
            }

            $this->validators[] = $validator;
        }
    }

    /**
     * @inheritDoc
     */
    public function validate(FlowInterface $flow): array
    {
        $result = [];

        foreach ($flow->getNodes() as $node) {
            $errors = [];

            foreach ($this->validators as $validator) {
                if ($validator->supports($node) && count($messages = $validator->validate($flow, $node))) {
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
