<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

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
    public function configure(AbstractSeoGenerator $generator)
    {
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
            $generator->setImage($url);
        }
    }
}
