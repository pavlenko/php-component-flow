<?php

namespace PE\Component\Flow\Definition;

interface NodeInterface extends IdentityInterface, LabelledInterface, MetadataInterface, SettingsInterface
{
    /**
     * @param string|null $type
     *
     * @return PortInterface[]
     */
    public function getPorts(?string $type = null): array;

    /**
     * @param PortInterface[] $ports
     */
    public function setPorts(array $ports): void;

    /**
     * @param string $id
     *
     * @return PortInterface|null
     */
    public function searchPort(string $id): ?PortInterface;

    /**
     * @param PortInterface $port
     */
    public function insertPort(PortInterface $port): void;

    /**
     * @param PortInterface $port
     */
    public function removePort(PortInterface $port): void;
}
