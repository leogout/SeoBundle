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
            $generator->setTitle($title['content'], $title['separator'], $title['prefix']);
        }
        if (null !== $description = $this->getConfig('description')) {
            $generator->setDescription($description['content']);
        }
        if (null !== $keywords = $this->getConfig('keywords')) {
            $generator->setKeywords($keywords['content']);
        }
        if (null !== $robots = $this->getConfig('robots')) {
            $generator->setRobots($robots['index'], $robots['follow']);
        }
        if (null !== $canonical = $this->getConfig('canonical')) {
            $generator->setCanonical($canonical['url']);
        }
    }

    /**
     * @param string $name
     *
     * @return array|null
     */
    private function getConfig($name)
    {
        if (!isset($this->config[$name])) {
            return null;
        }

        if (!$this->config[$name]['enabled']) {
            return null;
        }

        return $this->config[$name];
    }
}
