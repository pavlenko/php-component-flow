<?php

namespace PE\Component\Flow\Definition;

final class Node implements NodeInterface
{
    use IdentityTrait;
    use LabelledTrait;
    use MetadataTrait;
    use SettingsTrait;

    /**
     * @var PortInterface[]
     */
    private $ports = [];

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->identity = $id;
    }

    /**
     * @inheritDoc
     */
    public function getPorts(?string $type = null): array
    {
        if (!empty($type)) {
            return array_filter($this->ports, function (PortInterface $port) use ($type) {
                return $port->getType() === $type;
            });
        }

        return $this->ports;
    }

    /**
     * @inheritDoc
     */
    public function setPorts(array $ports): void
    {
        foreach ($this->ports as $port) {
            $this->removePort($port);
        }

        foreach ($ports as $port) {
            $this->insertPort($port);
        }
    }

    /**
     * @inheritDoc
     */
    public function searchPort(string $id): ?PortInterface
    {
        foreach ($this->ports as $port) {
            if ($port->getID() === $id) {
                return $port;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function insertPort(PortInterface $port): void
    {
        if (!in_array($port, $this->ports, true)) {
            $this->ports[] = $port;
        }
    }

    /**
     * @inheritDoc
     */
    public function removePort(PortInterface $port): void
    {
        if (false !== ($key = array_search($port, $this->ports, true))) {
            unset($this->ports[$key]);
        }

        $this->ports = array_values($this->ports);
    }
}
