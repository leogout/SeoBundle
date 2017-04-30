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
     * SeoGeneratorChain constructor.
     *
     * @param array $generators
     */
    public function __construct(array $generators)
    {
        $this->generators = $generators;
    }

    /**
     * @param string $alias
     *
     * @return array
     */
    public function get($alias)
    {
        if (!isset($this->generators[$alias])) {
            throw new \InvalidArgumentException(sprintf('The SEO generator with alias "%s" is not defined.', $alias));
        }

        return $this->generators[$alias];
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
