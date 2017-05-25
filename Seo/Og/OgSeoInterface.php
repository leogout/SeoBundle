<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

use Leogout\Bundle\SeoBundle\Seo\TitleSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\DescriptionSeoInterface;
use Leogout\Bundle\SeoBundle\Seo\ImageSeoInterface;

/**
 * Description of OgSeoInterface.
 *
 * @author: leogout
 */
interface OgSeoInterface extends TitleSeoInterface, DescriptionSeoInterface, ImageSeoInterface
{
}
