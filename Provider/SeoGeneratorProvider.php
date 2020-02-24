<?php

namespace Leogout\Bundle\SeoBundle\Provider;

use Leogout\Bundle\SeoBundle\Seo\AbstractSeoGenerator;

/**
 * Description of SeoGeneratorProvider.
 *
 * @author: leogout
 */
class SeoGeneratorProvider
{
    /**
     * @var AbstractSeoGenerator[]
     */
    protected $generators = [];

    /**
     * @param string $alias
     * @param AbstractSeoGenerator $generator
     *
     * @return self
     */
    public function set(string $alias, AbstractSeoGenerator $generator)
    {
        $this->generators[$alias] = $generator;

        return $this;
    }

    /**
     * @param string $alias
     *
     * @return AbstractSeoGenerator
     */
    public function get($alias)
    {
        if (!isset($this->generators[$alias])) {
            throw new \InvalidArgumentException(sprintf('The SEO generator with alias "%s" is not defined.', $alias));
        }

        return $this->generators[$alias];
    }

    /**
     * @return AbstractSeoGenerator[]
     */
    public function getAll()
    {
        return $this->generators;
    }

    /**
     * @param $alias
     *
     * @return bool
     */
    public function has($alias)
    {
        return isset($this->generators[$alias]);
    }
}
