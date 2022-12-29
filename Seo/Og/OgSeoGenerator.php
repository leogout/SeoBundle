<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\ImageSeoInterface;

/**
 * Description of OgSeoGenerator.
 *
 * @author: leogout
 */
class OgSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setType(string $content) : self
    {
        return $this->set('og:type', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getType() : ?MetaTag
    {
        return $this->get('og:type');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle(string $content) : self
    {
        return $this->set('og:title', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getTitle() : ?MetaTag
    {
        return $this->get('og:title');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription(string $content) : self
    {
        return $this->set('og:description', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getDescription() : ?MetaTag
    {
        return $this->get('og:description');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage(string $content) : self
    {
        return $this->set('og:image', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getImage() : ?MetaTag
    {
        return $this->get('og:image');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setUrl(string $content) : self
    {
        return $this->set('og:url', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getUrl() : ?MetaTag
    {
        return $this->get('og:url');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setSiteName(string $content) : self
    {
        return $this->set('og:site_name', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getSiteName() : ?MetaTag
    {
        return $this->get('og:site_name');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setLocale(string $content) : self
    {
        return $this->set('og:locale', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getLocale() : ?MetaTag
    {
        return $this->get('og:locale');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDeterminer(string $content) : self
    {
        return $this->set('og:determiner', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getDeterminer() : ?MetaTag
    {
        return $this->get('og:determiner');
    }

    /**
     * Generate seo tags from given resource.
     *
     * @param TitleSeoInterface|DescriptionSeoInterface|ImageSeoInterface $resource
     *
     * @return $this
     */
    public function fromResource(TitleSeoInterface|DescriptionSeoInterface|ImageSeoInterface $resource) : self
    {
        if ($resource instanceof TitleSeoInterface) {
            $this->setTitle($resource->getSeoTitle());
        }
        if ($resource instanceof DescriptionSeoInterface) {
            $this->setDescription($resource->getSeoDescription());
        }
        if ($resource instanceof ImageSeoInterface) {
            $this->setImage($resource->getSeoImage());
        }

        return $this;
    }

    /**
     * @param string $type
     *
     * @return MetaTag|null
     */
    public function get(string $type) : ?MetaTag
    {
        return $this->tagBuilder->getMeta($type);
    }

    /**
     * @param string $type
     * @param string $value
     *
     * @return $this
     */
    public function set(string $type, string $value) : self
    {
        $this->tagBuilder->addMeta($type)
            ->setType(MetaTag::PROPERTY_TYPE)
            ->setValue($type)
            ->setContent($value);

        return $this;
    }
}
