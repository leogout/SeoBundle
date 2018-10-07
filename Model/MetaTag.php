<?php

namespace Leogout\Bundle\SeoBundle\Model;

/**
 * Description of MetaTag.
 *
 * @author: leogout
 */
class MetaTag implements RenderableInterface
{
    const NAME_TYPE = 'name';
    const PROPERTY_TYPE = 'property';
    const HTTP_EQUIV_TYPE = 'http-equiv';

    /**
     * @var string
     */
    protected $type = self::NAME_TYPE;

    /**
     * @var string
     */
    protected $tagName;

    /**
     * @var string
     */
    protected $content;

    /**
     * If true, render one metadata tag for each value if the value is an array.
     * When false, we'll assume that the rendered metadata tag expects comma separated values.
     *
     * @var bool
     */
    protected $eachValueAsSeparateTag = true;

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
        if (!in_array($type, $this->getTypes())) {
            throw new \InvalidArgumentException(sprintf('Meta tag of type "%s" doesn\'t exist. Existing types are: name, property and http-equiv.', $type));
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return string
     */
    public function getTagName()
    {
        return $this->tagName;
    }

    /**
     * @param string $tagName
     *
     * @return $this
     */
    public function setTagName($tagName)
    {
        $this->tagName = (string) $tagName;

        return $this;
    }

    /**
     * @deprecated  use getTagName()
     *
     * @return string
     */
    public function getValue()
    {
        return $this->getTagName();
    }

    /**
     * @deprecated  use setTagName()
     *
     * @param $tagName
     *
     * @return MetaTag
     */
    public function setValue($tagName)
    {
        return $this->setTagName($tagName);
    }

    /**
     * @return string[]|string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string[]|string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return array
     */
    public function getTypes()
    {
        return [
            self::NAME_TYPE,
            self::PROPERTY_TYPE,
            self::HTTP_EQUIV_TYPE,
        ];
    }

    /**
     * @return string
     */
    public function render()
    {
        $tagContent = $this->getContent();
        if ($tagContent === null) {
            return '';
        }

        // Multiple values?
        if (is_array($tagContent)) {
            // Render one metadata tag for each value
            if ($this->isEachValueAsSeparateTag()) {
                $rendered = '';
                foreach ($tagContent as $tagValue) {
                    $rendered .= sprintf(
                        '<meta %s="%s" content="%s" />',
                        $this->getType(),
                        $this->getTagName(),
                        $tagValue
                    );
                }

                return $rendered;
            } else {
                // Assume tag expects comma separated value
                $tagContent = implode(', ', $tagContent);
            }
        }

        return sprintf('<meta %s="%s" content="%s" />', $this->getType(), $this->getTagName(), (string) $tagContent);
    }

    /**
     * @return bool
     */
    public function isEachValueAsSeparateTag()
    {
        return $this->eachValueAsSeparateTag;
    }

    /**
     * @param bool $eachValueAsSeparateTag
     *
     * @return $this
     */
    public function setEachValueAsSeparateTag($eachValueAsSeparateTag)
    {
        $this->eachValueAsSeparateTag = $eachValueAsSeparateTag;

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
