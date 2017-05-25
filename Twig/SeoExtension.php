<?php

namespace Leogout\Bundle\SeoBundle\Twig;

use Leogout\Bundle\SeoBundle\Model\RenderableInterface;
use Leogout\Bundle\SeoBundle\Provider\SeoGeneratorProvider;

/**
 * Description of SeoExtension.
 *
 * @author: leogout
 */
class SeoExtension extends \Twig_Extension
{
    /**
     * @var SeoGeneratorProvider
     */
    protected $generatorProvider;

    /**
     * SeoExtension constructor.
     *
     * @param SeoGeneratorProvider $generatorProvider
     */
    public function __construct(SeoGeneratorProvider $generatorProvider)
    {
        $this->generatorProvider = $generatorProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('leogout_seo', [$this, 'seo'], ['is_safe' => ['html']]),
        );
    }

    /**
     * @param $alias
     *
     * @return string
     */
    public function seo($alias = null)
    {
        if (null !== $alias) {
            return $this->generatorProvider->get($alias)->render();
        }

        return implode(PHP_EOL,
            array_map(function (RenderableInterface $tag) {
                return $tag->render();
            }, $this->generatorProvider->getAll())
        );
    }

    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'leogout_seo.twig.seo_extension';
    }
}
