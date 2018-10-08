<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Interface DimensionsAwareInterface
 *
 * @author Daan Biesterbos https://www.linkedin.com/in/daan-biesterbos
 */
interface DimensionsAwareInterface
{
    /**
     * @optional
     *
     * @return int|null
     */
    public function getWidth();

    /**
     * @optional
     *
     * @return int|null
     */
    public function getHeight();
}