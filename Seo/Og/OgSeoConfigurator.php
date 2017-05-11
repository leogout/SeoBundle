<?php

namespace Leogout\Bundle\SeoBundle\Seo\Og;

/**
 * Description of OgSeoConfigurator.
 *
 * @author: leogout
 */
class OgSeoConfigurator
{
    /**
     * @var array
     */
    protected $config;

    /**
     * OgSeoConfigurator constructor.
     *
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param OgSeoGenerator $generator
     */
    public function configure(OgSeoGenerator $generator)
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
