<?php

namespace Leogout\Bundle\SeoBundle\Seo\Basic;

use Leogout\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\KeywordsSeoInterface;

/**
 * Description of BasicSeoInterface.
 *
 * @author: leogout
 */
interface BasicSeoInterface extends TitleSeoInterface, DescriptionSeoInterface, KeywordsSeoInterface
{
}
