<?php

namespace Leogout\Bundle\SeoBundle\Seo;

/**
 * Description of AbstractSeoConfigurator.
 *
 * @author: leogout
 */
abstract class AbstractSeoConfigurator
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
     * @param AbstractSeoGenerator $generator
     */
    abstract public function configure(AbstractSeoGenerator $generator);

    /**
     * @param string $name
     *
     * @return mixed|null
     */
    protected function getConfig($name)
    {
        if (!isset($this->config[$name])) {
            return null;
        }

        return $this->config[$name];
    }
}
