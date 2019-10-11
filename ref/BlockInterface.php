<?php

namespace app\extensions\flow;

interface BlockInterface extends IdentityInterface, LabelledInterface, OptionsInterface, StatusesInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * @param string|null $type
     *
     * @return PortInterface[]
     */
    public function getPorts(string $type = null): array;

    /**
     * @param PortInterface[] $ports
     *
     * @return static
     */
    public function setPorts(array $ports);

    /**
     * @param string $portID
     *
     * @return PortInterface|null
     */
    public function searchPort(string $portID): ?PortInterface;

    /**
     * @param PortInterface $port
     *
     * @return static
     */
    public function insertPort(PortInterface $port);

    /**
     * @param PortInterface $port
     *
     * @return static
     */
    public function removePort(PortInterface $port);
}
