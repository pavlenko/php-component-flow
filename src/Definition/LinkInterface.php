<?php

namespace PE\Flow\Definition;

interface LinkInterface extends IdentityInterface
{
    /**
     * @return string
     */
    public function getSourcePortID(): string;

    /**
     * @return string
     */
    public function getTargetPortID(): string;

    /**
     * @param FlowInterface $flow
     * @return PortInterface|null
     */
    public function getSourcePort(FlowInterface $flow): ?PortInterface;

    /**
     * @param FlowInterface $flow
     * @return PortInterface|null
     */
    public function getTargetPort(FlowInterface $flow): ?PortInterface;
}
