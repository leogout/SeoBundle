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
    protected string $type = self::NAME_TYPE;

    /**
     * @var string|null
     */
    protected ?string $value = null;

    /**
     * @var string|null
     */
    protected ?string $content = null;

    /**
     * @return string
     */
    public function getType() : string
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return $this
     */
    public function setType(string $type) : self
    {
        if (!in_array($type, $this->getTypes())) {
            throw new \InvalidArgumentException(sprintf('Meta tag of type "%s" doesn\'t exist. Existing types are: name, property and http-equiv.', $type));
        }

        $this->type = $type;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getValue() : ?string
    {
        return $this->value;
    }

    /**
     * @param string|null $value
     *
     * @return $this
     */
    public function setValue(?string $value) : self
    {
        $this->value = $value;

        return $this;
    }

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
     * @return array
     */
    public function getTypes() : array
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
    public function render() : string
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
