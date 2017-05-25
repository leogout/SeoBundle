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
    public function setCard($content)
    {
        return $this->set('twitter:card', $content);
    }

    /**
     * @return MetaTag
     */
    public function getCard()
    {
        return $this->get('twitter:card');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        return $this->set('twitter:title', $content);
    }

    /**
     * @return MetaTag
     */
    public function getTitle()
    {
        return $this->get('twitter:title');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setSite($content)
    {
        return $this->set('twitter:site', $content);
    }

    /**
     * @return MetaTag
     */
    public function getSite()
    {
        return $this->get('twitter:site');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        return $this->set('twitter:description', $content);
    }

    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->get('twitter:description');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage($content)
    {
        return $this->set('twitter:image', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImage()
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
    public function fromResource($resource)
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
     * @return MetaTag
     */
    public function get($type)
    {
        return $this->tagBuilder->getMeta($type);
    }

    /**
     * @param string $type
     * @param string $value
     *
     * @return $this
     */
    public function set($type, $value)
    {
        $this->tagBuilder->addMeta($type)
            ->setType(MetaTag::NAME_TYPE)
            ->setValue($type)
            ->setContent((string) $value);

        return $this;
    }
}
