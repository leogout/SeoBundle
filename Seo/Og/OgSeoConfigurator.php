<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

use Leogout\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoConfigurator;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;

/**
 * Description of OgSeoConfigurator.
 *
 * @author: leogout
 */
class OgSeoConfigurator extends AbstractSeoConfigurator
{
    /**
     * @param AbstractSeoGenerator $generator
     */
    public function configure(AbstractSeoGenerator $generator) : void
    {
        if (!($generator instanceof OgSeoGenerator)) {
            throw new InvalidSeoGeneratorException(__CLASS__, OgSeoGenerator::class, get_class($generator));
        }
        if (null !== $title = $this->getConfig('title')) {
            $generator->setTitle($title);
        }
        if (null !== $description = $this->getConfig('description')) {
            $generator->setDescription($description);
        }
        if (null !== $image = $this->getConfig('image')) {
            $generator->setImage($image);
        }
        if (null !== $type = $this->getConfig('type')) {
            $generator->setType($type);
        }
        if (null !== $url = $this->getConfig('url')) {
            $generator->setUrl($url);
        }
        if (null !== $siteName = $this->getConfig('site_name')) {
            $generator->setSiteName($siteName);
        }
        if (null !== $locale = $this->getConfig('locale')) {
            $generator->setLocale($locale);
        }
        if (null !== $locale = $this->getConfig('determiner')) {
            $generator->setDeterminer($locale);
        }
    }
}
