<?php

namespace PE\Flow\Validation;

use PE\Flow\Definition\FlowInterface;

final class Validator
{
    /**
     * @var ConstraintInterface[]
     */
    private array $constraints = [];

    /**
     * @param ConstraintInterface[] $constraints
     */
    public function __construct(array $constraints = [])
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($constraint);
        }
    }

    /**
     * @param ConstraintInterface $constraint
     * @return $this
     */
    public function addConstraint(ConstraintInterface $constraint): self
    {
        $this->constraints[spl_object_hash($constraint)] = $constraint;
        return $this;
    }

    /**
     * @param FlowInterface $flow
     * @param array|null    $messages
     * @return bool
     */
    public function validate(FlowInterface $flow, array &$messages = null): bool
    {
        $messages = $messages ?? [];

        // Check flow empty
        if (0 === count($flow->getNodes())) {
            $messages[] = sprintf('Flow %s is empty', $flow->getID());
        }

        // Check blocks without ports
        foreach ($flow->getNodes() as $node) {
            if (0 === count($node->getPorts($flow))) {
                $messages[] = sprintf('Block %s has no ports', $node->getID());
            }
        }

        // Check unconnected ports
        foreach ($flow->getPorts() as $port) {
            if (0 === count($port->getLinks($flow))) {
                $messages[] = sprintf('Port %s is unconnected', $port->getID());
            }
        }

        if (!empty($messages)) {
            return false;
        }

        // Check custom constraints
        foreach ($flow->getNodes() as $node) {
            foreach ($this->constraints as $constraint) {
                $constraint->validate($node, $flow, $messages);
            }
        }

        return empty($messages);
    }
}
