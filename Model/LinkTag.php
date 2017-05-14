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
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $rel;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $href;

    /**
     * @return string
     */
    public function getHref()
    {
        return $this->href;
    }

    /**
     * @param string $href
     *
     * @return $this
     */
    public function setHref($href)
    {
        $this->href = (string) $href;

        return $this;
    }

    /**
     * @return string
     */
    public function getRel()
    {
        return $this->rel;
    }

    /**
     * @param string $rel
     *
     * @return $this
     */
    public function setRel($rel)
    {
        $this->rel = (string) $rel;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType($type)
    {
        $this->type = (string) $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = (string) $title;

        return $this;
    }

    /**
     * Returns a string only if $value isn't null
     *
     * @param string $format
     * @param string $value
     *
     * @return string
     */
    private function sprintfIfNotNull($format, $value)
    {
        if ('' === $value || null === $value) {
            return '';
        }

        return sprintf($format, $value);
    }

    /**
     * @return string
     */
    public function render()
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
