<?php

namespace Leogout\Bundle\SeoBundle\Seo\Stdlib;

/**
 * Interface LocalizationAwareInterface
 *
 * @author Daan Biesterbos  https://www.linkedin.com/in/daan-biesterbos
 */
interface LocalizationAwareInterface
{
    /**
     * @optional
     *
     * @return string e.g.  en_US
     */
    public function getLocale();

    /**
     * @optional
     *
     * @return string[]|string|null
     */
    public function getAlternateLocales();
}