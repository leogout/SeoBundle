<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Interface PageInterface
 *
 * @author Daan Biesterbos  https://www.linkedin.com/in/daan-biesterbos
 */
interface ResourceInterface extends WebsiteInterface
{
    /**
     * @return string|null
     */
    public function getTitle();

    /**
     * @return string|null
     */
    public function getDescription();

    /**
     * @return string[]|string|null
     */
    public function getKeywords();
}