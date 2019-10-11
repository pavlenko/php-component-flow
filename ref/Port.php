<?php

namespace app\extensions\flow;

final class Port implements PortInterface
{
    use IdentityTrait;
    use LabelledTrait;
    use OptionsTrait;

    /**
     * @var string
     */
    private $type;

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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @inheritDoc
     */
    public function setType(string $type)
    {
        $this->type = $type;
        return $this;
    }
}
