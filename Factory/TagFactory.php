<?php

namespace Leogout\Bundle\SeoBundle\Factory;

use Leogout\Bundle\SeoBundle\Model\LinkTag;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Model\TitleTag;

/**
 * Description of TagFactory.
 *
 * @author: leogout
 */
class TagFactory
{
    /**
     * @return TitleTag
     */
    public function createTitle()
    {
        $titleTag = new TitleTag();

        return $titleTag;
    }

    /**
     * @return MetaTag
     */
    public function createMeta()
    {
        $metaTag = new MetaTag();

        return $metaTag;
    }

    /**
     * @return LinkTag
     */
    public function createLink()
    {
        $linkTag = new LinkTag();

        return $linkTag;
    }
}
