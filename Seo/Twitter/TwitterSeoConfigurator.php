<?php

namespace Leogout\Bundle\SeoBundle\Seo\Twitter;

/**
 * Description of TwitterSeoConfigurator.
 *
 * @author: leogout
 */
class TwitterSeoConfigurator
{
    /**
     * @var array
     */
    protected $config;

    /**
     * TwitterSeoConfigurator constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param TwitterSeoGenerator $generator
     */
    public function configure(TwitterSeoGenerator $generator)
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
        if (null !== $card = $this->getConfig('card')) {
            $generator->setCard($card);
        }
        if (null !== $site = $this->getConfig('site')) {
            $generator->setSite($site);
        }
    }

    /**
     * @param string $name
     *
     * @return string|null
     */
    private function getConfig($name)
    {
        if (!isset($this->config[$name])) {
            return null;
        }

        return $this->config[$name];
    }
}
