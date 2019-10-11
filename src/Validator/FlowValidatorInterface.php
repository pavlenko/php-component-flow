<?php

namespace PE\Component\Flow\Validator;

use PE\Component\Flow\Definition\FlowInterface;

interface FlowValidatorInterface
{
    /**
     * @param FlowInterface $flow
     *
     * @return string[]
     */
    public function validate(FlowInterface $flow): array;
}
