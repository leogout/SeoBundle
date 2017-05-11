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
            $generator->setTitle($title);
        }
        if (null !== $description = $this->getConfig('description')) {
            $generator->setDescription($description);
        }
        if (null !== $keywords = $this->getConfig('keywords')) {
            $generator->setKeywords($keywords);
        }
        if (null !== $robots = $this->getConfig('robots')) {
            $generator->setRobots($robots['index'], $robots['follow']);
        }
        if (null !== $canonical = $this->getConfig('canonical')) {
            $generator->setCanonical($canonical);
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
