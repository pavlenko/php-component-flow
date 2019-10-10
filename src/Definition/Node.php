<?php

namespace PE\Component\Flow\Definition;

final class Node implements NodeInterface
{
    use IdentityTrait;
    use LabelledTrait;

    /**
     * @var PortInterface[]
     */
    private $ports = [];

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
        $this->ports = [];

        foreach ($ports as $port) {
            if (!($port instanceof PortInterface)) {
                throw new \UnexpectedValueException(sprintf(
                    'Port must be instance of %s, but got %s',
                    PortInterface::class,
                    is_object($port) ? get_class($port) : gettype($port)
                ));
            }

            $this->ports[] = $port;
        }
    }
}
