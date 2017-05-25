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
    public function setType($content)
    {
        return $this->set('og:type', $content);
    }

    /**
     * @return MetaTag
     */
    public function getType()
    {
        return $this->get('og:type');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        return $this->set('og:title', $content);
    }

    /**
     * @return MetaTag
     */
    public function getTitle()
    {
        return $this->get('og:title');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        return $this->set('og:description', $content);
    }

    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->get('og:description');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage($content)
    {
        $this->tagBuilder->addMeta('og:image')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('og:image')
            ->setContent((string) $content);

        return $this->set('og:image', $content);
    }

    /**
     * @return MetaTag
     */
    public function getImage()
    {
        return $this->get('og:image');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setUrl($content)
    {
        return $this->set('og:url', $content);
    }

    /**
     * @return MetaTag
     */
    public function getUrl()
    {
        return $this->get('og:url');
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
