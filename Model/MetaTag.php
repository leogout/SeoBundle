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
    protected $value;

    /**
     * @var string
     */
    protected $content;

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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = (string) $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setContent($content)
    {
        $this->content = (string) $content;

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
        return sprintf('<meta %s="%s" content="%s" />', $this->getType(), $this->getValue(), $this->getContent());
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
