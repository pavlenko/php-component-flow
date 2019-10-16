<?php

namespace PE\Component\Flow\Definition;

final class Port implements PortInterface
{
    use IdentityTrait;
    use LabelledTrait;
    use MetadataTrait;
    use SettingsTrait;

    /**
     * @var string
     */
    private $type;

    /**
     * @param string      $id
     * @param string|null $type
     */
    public function __construct(string $id, string $type = null)
    {
        $this->identity = $id;

        if ($type) {
            $this->setType($type);
        }
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
    public function setType(string $type): void
    {
        $allowed = [self::TYPE_I, self::TYPE_O];

        if (!in_array($type, $allowed)) {
            throw new \UnexpectedValueException('Type must be one of ' . json_encode($allowed));
        }

        $this->type = $type;
    }
}
