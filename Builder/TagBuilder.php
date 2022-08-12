<?php

namespace Leogout\Bundle\SeoBundle\Builder;

use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Model\LinkTag;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Model\RenderableInterface;
use Leogout\Bundle\SeoBundle\Model\TitleTag;

/**
 * Description of TagBuilder.
 *
 * @author: leogout
 */
class TagBuilder implements RenderableInterface
{
    /**
     * @var TagFactory
     */
    protected TagFactory $tagFactory;

    /**
     * @var TitleTag|null
     */
    protected ?TitleTag $title = null;

    /**
     * @var MetaTag[]
     */
    protected array $metas = [];

    /**
     * @var LinkTag[]
     */
    protected array $links = [];

    /**
     * TagBuilder constructor.
     *
     * @param TagFactory $tagFactory
     */
    public function __construct(TagFactory $tagFactory)
    {
        $this->tagFactory = $tagFactory;
    }

    /**
     * @param string $title
     *
     * @return TitleTag
     */
    public function setTitle(string $title) : TitleTag
    {
        return $this->title = $this->tagFactory
            ->createTitle()
            ->setContent($title);
    }

    /**
     * @return TitleTag|null
     */
    public function getTitle(): ?TitleTag
    {
        return $this->title;
    }

    /**
     * @param string      $name
     * @param string $type
     * @param string|null $value
     * @param string|null $content
     *
     * @return MetaTag
     */
    public function addMeta(string $name, string $type = MetaTag::NAME_TYPE, ?string $value = null,
                            ?string $content = null) : MetaTag
    {
        return $this->metas[$name] = $this->tagFactory
            ->createMeta()
            ->setType($type)
            ->setValue($value)
            ->setContent($content);
    }

    /**
     * @param $name
     *
     * @return MetaTag|null
     */
    public function getMeta($name) : ?MetaTag
    {
        return $this->metas[$name] ?? null;
    }

    /**
     * @param string      $name
     * @param string|null $href
     * @param string|null $rel
     * @param string|null $type
     * @param string|null $title
     *
     * @return LinkTag
     */
    public function addLink(string $name, ?string $href = null, ?string $rel = null, ?string $type = null,
                            ?string $title = null) : LinkTag
    {
        return $this->links[$name] = $this->tagFactory
            ->createLink()
            ->setHref($href)
            ->setRel($rel)
            ->setType($type)
            ->setTitle($title);
    }

    /**
     * @param string $name
     *
     * @return LinkTag|null
     */
    public function getLink(string $name) : ?LinkTag
    {
        return $this->links[$name] ?? null;
    }

    /**
     * @return string
     */
    public function render() : string
    {
        $tags = [];

        if (null !== $this->title) {
            $tags[] = $this->title;
        }
        if (count($this->metas) > 0) {
            $tags = array_merge($tags, $this->metas);
        }
        if (count($this->links) > 0) {
            $tags = array_merge($tags, $this->links);
        }

        return implode(PHP_EOL,
            array_map(function (RenderableInterface $tag) {
                return $tag->render();
            }, $tags)
        );
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
