<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Interface ImageAwareInterface
 *
 * @author Daan Biesterbos https://www.linkedin.com/in/daan-biesterbos
 */
interface ImageAggregateInterface
{
    /**
     * @return ImageInterface|null
     */
    public function getImage();
}