<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Interface AudioAwareInterface
 *
 * @author Daan Biesterbos https://www.linkedin.com/in/daan-biesterbos
 */
interface AudioAggregateInterface
{
    /**
     * @return AudioInterface
     */
    public function getAudio();
}