<?php

namespace Leogout\Bundle\SeoBundle\Seo\Twitter;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
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
        $this->tagBuilder->addMeta('twitter:card')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('twitter:card')
            ->setContent((string) $content);

        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getCard()
    {
        return $this->tagBuilder->getMeta('twitter:card');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle($content)
    {
        $this->tagBuilder->addMeta('twitter:title')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('twitter:title')
            ->setContent((string) $content);

        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getTitle()
    {
        return $this->tagBuilder->getMeta('twitter:title');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setSite($content)
    {
        $this->tagBuilder->addMeta('twitter:site')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('twitter:site')
            ->setContent((string) $content);

        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getSite()
    {
        return $this->tagBuilder->getMeta('twitter:site');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription($content)
    {
        $this->tagBuilder->addMeta('twitter:description')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('twitter:description')
            ->setContent((string) $content);

        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getDescription()
    {
        return $this->tagBuilder->getMeta('twitter:description');
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setImage($content)
    {
        $this->tagBuilder->addMeta('twitter:image')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('twitter:image')
            ->setContent((string) $content);

        return $this;
    }

    /**
     * @return MetaTag
     */
    public function getImage()
    {
        return $this->tagBuilder->getMeta('twitter:image');
    }

    /**
     * Generate seo tags from given resource.
     *
     * @param TitleSeoInterface|DescriptionSeoInterface|KeywordsSeoInterface $resource
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
     * @return string
     */
    public function render()
    {
        return $this->tagBuilder->render();
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->render();
    }
}
