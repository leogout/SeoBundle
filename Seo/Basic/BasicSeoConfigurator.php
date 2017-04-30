<?php

namespace Leogout\Bundle\SeoBundle\Seo\Basic;

/**
 * Description of BasicSeoConfigurator.
 *
 * @author: leogout
 */
class BasicSeoConfigurator
{
    /**
     * @var array
     */
    protected $config;

    /**
     * BasicSeoConfigurator constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param BasicSeoGenerator $generator
     */
    public function configure(BasicSeoGenerator $generator)
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
     * @return bool
     */
    private function getConfig($name)
    {
        if (!isset($this->config[$name])) {
            return;
        }

        if (!$this->config[$name]['enabled']) {
            return;
        }

        return $this->config[$name];
    }
}
