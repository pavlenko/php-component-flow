<?php

namespace PE\Component\Flow\Definition;

/**
 * @codeCoverageIgnore
 */
trait MetadataTrait
{
    /**
     * @var array
     */
    private $metadata = [];

    /**
     * @return array
     */
    public function getMetadata(): array
    {
        return $this->metadata;
    }

    /**
     * @param array $items
     */
    public function setMetadata(array $items): void
    {
        $this->metadata = $items;
    }

    /**
     * @param string $name
     *
     * @return bool
     */
    public function hasMetadataItem(string $name): bool
    {
        return array_key_exists($name, $this->metadata);
    }

    /**
     * @param string $name
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getMetadataItem(string $name, $default = null)
    {
        return $this->metadata[$name] ?? $default;
    }

    /**
     * @param string $name
     * @param mixed  $value
     */
    public function setMetadataItem(string $name, $value): void
    {
        $this->metadata[$name] = $value;
    }

    /**
     * @param string $name
     */
    public function delMetadataItem(string $name): void
    {
        unset($this->metadata[$name]);
    }
}
