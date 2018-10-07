<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Class ImageInterface
 *
 * @author Daan Biesterbos  https://www.linkedin.com/in/daan-biesterbos
 */
interface ImageInterface extends MediaInterface, DimensionsAwareInterface
{
    /**
     * @optional
     *
     * @return string|null
     */
    public function getImageAlt();
}