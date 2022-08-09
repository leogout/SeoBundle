<?php

namespace Leogout\Bundle\SeoBundle\Model;

/**
 * Description of LinkTag.
 *
 * @author: leogout
 */
class LinkTag implements RenderableInterface
{
    /**
     * @var string|null
     */
    protected ?string $type = null;

    /**
     * @var string|null
     */
    protected ?string $rel = null;

    /**
     * @var string|null
     */
    protected ?string $title = null;

    /**
     * @var string|null
     */
    protected ?string $href = null;

    /**
     * @return string|null
     */
    public function getHref() : ?string
    {
        return $this->href;
    }

    /**
     * @param string|null $href
     *
     * @return $this
     */
    public function setHref(?string $href) : self
    {
        $this->href = $href;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getRel() : ?string
    {
        return $this->rel;
    }

    /**
     * @param string|null $rel
     *
     * @return $this
     */
    public function setRel(?string $rel) : self
    {
        $this->rel = $rel;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getType() : ?string
    {
        return $this->type;
    }

    /**
     * @param string|null $type
     *
     * @return $this
     */
    public function setType(?string $type) : self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle() : ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     *
     * @return $this
     */
    public function setTitle(?string $title) : self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Returns a string only if $value isn't null
     *
     * @param string $format
     * @param string|null $value
     *
     * @return string
     */
    private function sprintfIfNotNull(string $format, ?string $value) : string
    {
        if ('' === $value || null === $value) {
            return '';
        }

        return sprintf($format, $value);
    }

    /**
     * @return string
     */
    public function render() : string
    {
        $href = $this->sprintfIfNotNull('href="%s" ', $this->getHref());
        $rel = $this->sprintfIfNotNull('rel="%s" ', $this->getRel());
        $type = $this->sprintfIfNotNull('type="%s" ', $this->getType());
        $title = $this->sprintfIfNotNull('title="%s" ', $this->getTitle());

        return sprintf('<link %s%s%s%s/>', $href, $rel, $type, $title);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
