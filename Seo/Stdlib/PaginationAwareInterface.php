<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Interface PaginationSeoInterface
 */
interface PaginationAwareInterface
{
    /**
     * @return null|string
     */
    public function getPreviousUrl();

    /**
     * @return null|string
     */
    public function getNextUrl();
}