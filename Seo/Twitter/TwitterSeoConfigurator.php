<?php

namespace Leogout\Bundle\SeoBundle\Seo\Twitter;

use Leogout\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoConfigurator;
use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;

/**
 * Description of TwitterSeoConfigurator.
 *
 * @author: leogout
 */
class TwitterSeoConfigurator extends AbstractSeoConfigurator
{
    /**
     * @param AbstractSeoGenerator $generator
     */
    public function configure(AbstractSeoGenerator $generator)
    {
        if (!($generator instanceof TwitterSeoGenerator)) {
            throw new InvalidSeoGeneratorException(__CLASS__, TwitterSeoGenerator::class, get_class($generator));
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
        if (null !== $card = $this->getConfig('card')) {
            $generator->setCard($card);
        }
        if (null !== $site = $this->getConfig('site')) {
            $generator->setSite($site);
        }
    }
}
