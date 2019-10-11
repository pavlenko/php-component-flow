<?php

namespace app\extensions\flow;

final class Flow implements FlowInterface
{
    use IdentityTrait;
    use LabelledTrait;

    /**
     * @var BlockInterface[]
     */
    private $blocks = [];

    /**
     * @var LinkInterface[]
     */
    private $links = [];

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
    public function getBlocks(): array
    {
        return $this->blocks;
    }

    /**
     * @inheritDoc
     */
    public function setBlocks(array $blocks)
    {
        foreach ($this->blocks as $block) {
            $this->removeBlock($block);
        }

        foreach ($blocks as $block) {
            $this->insertBlock($block);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function searchBlock(string $blockID): ?BlockInterface
    {
        foreach ($this->blocks as $block) {
            if ($block->getID() === $blockID) {
                return $block;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function insertBlock(BlockInterface $block)
    {
        if (!in_array($block, $this->blocks, true)) {
            $this->blocks[] = $block;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeBlock(BlockInterface $block)
    {
        if (false !== ($key = array_search($block, $this->blocks, true))) {
            unset($this->blocks[$key]);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @inheritDoc
     */
    public function setLinks(array $links)
    {
        foreach ($this->links as $link) {
            $this->removeLink($link);
        }

        foreach ($links as $link) {
            $this->insertLink($link);
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function searchLink(string $linkID): ?LinkInterface
    {
        foreach ($this->links as $link) {
            if ($link->getID() === $linkID) {
                return $link;
            }
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function insertLink(LinkInterface $link)
    {
        if (!in_array($link, $this->links, true)) {
            $this->links[] = $link;
        }

        return $this;
    }

    /**
     * @inheritDoc
     */
    public function removeLink(LinkInterface $link)
    {
        if (false !== ($key = array_search($link, $this->links, true))) {
            unset($this->links[$key]);
        }

        return $this;
    }
}
