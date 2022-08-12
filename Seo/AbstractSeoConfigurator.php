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
    protected array $config;

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
    abstract public function configure(AbstractSeoGenerator $generator) : void;

    /**
     * @param string $name
     *
     * @return mixed
     */
    protected function getConfig(string $name) : mixed
    {
        if (!isset($this->config[$name])) {
            return null;
        }

        return $this->config[$name];
    }
}
