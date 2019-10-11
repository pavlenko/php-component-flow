<?php

namespace app\extensions\flow;

final class Block implements BlockInterface
{
    use IdentityTrait;
    use LabelledTrait;
    use OptionsTrait;
    use StatusesTrait;

    /**
     * @var string
     */
    private $type;

    /**
     * @var PortInterface[]
     */
    private $ports = [];

    /**
     * @param string $id
     * @param string $type
     */
    public function __construct(string $id, string $type)
    {
        $this->identity = $id;
        $this->type     = $type;
    }

    /**
     * @inheritDoc
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function getPorts(string $type = null): array
    {
        $result = [];
        foreach ($this->ports as $port) {
            if (!$type || $port->getType() === $type) {
                $result[] = $port;
            }
        }

        return $result;
    }

    /**
     * @inheritDoc
     */
    public function setPorts(array $ports)
    {
        foreach ($this->ports as $port) {
            $this->removePort($port);
        }

        foreach ($ports as $port) {
            $this->insertPort($port);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function searchPort(string $portID): ?PortInterface
    {
        foreach ($this->ports as $port) {
            if ($port->getID() === $portID) {
                return $port;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function insertPort(PortInterface $port)
    {
        if (!in_array($port, $this->ports, true)) {
            $this->ports[] = $port;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removePort(PortInterface $port)
    {
        if (false !== ($key = array_search($port, $this->ports, true))) {
            unset($this->ports[$key]);
        }

        return $this;
    }
}
