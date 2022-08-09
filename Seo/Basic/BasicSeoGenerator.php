<?php

namespace Leogout\Bundle\SeoBundle\Seo\Basic;

use Leogout\Bundle\SeoBundle\Model\LinkTag;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Model\TitleTag;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\KeywordsSeoInterface;

/**
 * Description of BasicSeoGenerator.
 *
 * @author: leogout
 */
class BasicSeoGenerator extends AbstractSeoGenerator
{
    /**
     * @param string $content
     *
     * @return $this
     */
    public function setTitle(string $content) : self
    {
        $this->tagBuilder->setTitle($content);

        return $this;
    }

    /**
     * @return TitleTag|null
     */
    public function getTitle() : ?TitleTag
    {
        return $this->tagBuilder->getTitle();
    }

    /**
     * @param string $content
     *
     * @return $this
     */
    public function setDescription(string $content) : self
    {
        $this->tagBuilder->addMeta('description')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('description')
            ->setContent($content);

        return $this;
    }

    /**
     * @return MetaTag|null
     */
    public function getDescription() : ?MetaTag
    {
        return $this->tagBuilder->getMeta('description');
    }

    /**
     * @param string $keywords
     *
     * @return $this
     */
    public function setKeywords(string $keywords) : self
    {
        $this->tagBuilder->addMeta('keywords')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('keywords')
            ->setContent($keywords);

        return $this;
    }

    /**
     * @return MetaTag|null
     */
    public function getKeywords() : ?MetaTag
    {
        return $this->tagBuilder->getMeta('keywords');
    }

    /**
     * @param bool $shouldIndex
     * @param bool $shouldFollow
     *
     * @return $this
     */
    public function setRobots(bool $shouldIndex, bool $shouldFollow) : self
    {
        $index = $shouldIndex ? 'index' : 'noindex';
        $follow = $shouldFollow ? 'follow' : 'nofollow';

        $this->tagBuilder->addMeta('robots')
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('robots')
            ->setContent(sprintf('%s, %s', $index, $follow));

        return $this;
    }

    /**
     * @return MetaTag|null
     */
    public function getRobots() : ?MetaTag
    {
        return $this->tagBuilder->getMeta('robots');
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setCanonical(string $url) : self
    {
        $this->tagBuilder->addLink('canonical')
            ->setHref($url)
            ->setRel('canonical');

        return $this;
    }

    /**
     * @return LinkTag|null
     */
    public function getCanonical() : ?LinkTag
    {
        return $this->tagBuilder->getLink('canonical');
    }

    /**
     * @param string $url
     *
     * @return $this
     */
    public function setAmpHtml(string $url) : self
    {
        $this->tagBuilder->addLink('amphtml')
            ->setHref($url)
            ->setRel('amphtml');

        return $this;
    }

    /**
     * @return LinkTag|null
     */
    public function getAmpHtml() : ?LinkTag
    {
        return $this->tagBuilder->getLink('amphtml');
    }

    /**
     * Generate seo tags from given resource.
     *
     * @param TitleSeoInterface|DescriptionSeoInterface|KeywordsSeoInterface $resource
     *
     * @return $this
     */
    public function fromResource(TitleSeoInterface|DescriptionSeoInterface|KeywordsSeoInterface $resource) : self
    {
        if ($resource instanceof TitleSeoInterface) {
            $this->setTitle($resource->getSeoTitle());
        }
        if ($resource instanceof DescriptionSeoInterface) {
            $this->setDescription($resource->getSeoDescription());
        }
        if ($resource instanceof KeywordsSeoInterface) {
            $this->setKeywords($resource->getSeoKeywords());
        }

        return $this;
    }
}
