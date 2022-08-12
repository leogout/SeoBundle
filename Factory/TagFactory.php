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
    public function createTitle() : TitleTag
    {
        return new TitleTag();
    }

    /**
     * @return MetaTag
     */
    public function createMeta() : MetaTag
    {
        return new MetaTag();
    }

    /**
     * @return LinkTag
     */
    public function createLink() : LinkTag
    {
        return new LinkTag();
    }
}
