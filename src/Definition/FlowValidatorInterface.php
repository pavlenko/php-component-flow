<?php

namespace PE\Component\Flow\Definition;

interface FlowValidatorInterface
{
    /**
     * @param FlowInterface $flow
     *
     * @return string[]
     */
    public function validate(FlowInterface $flow): array;
}
