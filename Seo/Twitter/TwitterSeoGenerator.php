<?php

namespace Leogout\Bundle\SeoBundle\Seo\Twitter;

use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\ImageSeoInterface;

/**
 * Description of TwitterSeoGenerator.
 *
 * @author: leogout
 */
class TwitterSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setCard(string $content) : self
    {
        return $this->set('twitter:card', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getCard() : ?MetaTag
    {
        return $this->get('twitter:card');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle(string $content) : self
    {
        return $this->set('twitter:title', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getTitle() : ?MetaTag
    {
        return $this->get('twitter:title');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setSite(string $content) : self
    {
        return $this->set('twitter:site', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getSite() : ?MetaTag
    {
        return $this->get('twitter:site');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription(string $content) : self
    {
        return $this->set('twitter:description', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getDescription() : ?MetaTag
    {
        return $this->get('twitter:description');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage(string $content) : self
    {
        return $this->set('twitter:image', $content);
    }

    /**
     * @return MetaTag|null
     */
    public function getImage() : ?MetaTag
    {
        return $this->get('twitter:image');
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
            ->setType(MetaTag::NAME_TYPE)
            ->setValue($type)
            ->setContent($value);

        return $this;
    }
}
