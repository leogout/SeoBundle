<?php

namespace Leogout\Bundle\SeoBundle\Model;

/**
 * Description of TitleTag.
 *
 * @author: leogout
 */
class TitleTag implements RenderableInterface
{
    /**
     * @var string|null
     */
    protected ?string $content = null;

    /**
     * @return string|null
     */
    public function getContent() : ?string
    {
        return $this->content;
    }

    /**
     * @param string|null $content
     *
     * @return $this
     */
    public function setContent(?string $content) : self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function render() : string
    {
        $content = $this->getContent();
        return sprintf('<title>%s</title>', is_null($content) ? '' : $content);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
