<?php

namespace Leogout\Bundle\SeoBundle\Twig;

use Leogout\Bundle\SeoBundle\Model\RenderableInterface;
use Leogout\Bundle\SeoBundle\Provider\SeoGeneratorProvider;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Description of SeoExtension.
 *
 * @author: leogout
 */
class SeoExtension extends AbstractExtension
{
    /**
     * @var SeoGeneratorProvider
     */
    protected SeoGeneratorProvider $generatorProvider;

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
     * @return array|TwigFunction[]
     */
    public function getFunctions()
    {
        return array(
            new TwigFunction('leogout_seo', [$this, 'seo'], ['is_safe' => ['html']]),
        );
    }

    /**
     * @param string|null $alias
     *
     * @return string
     */
    public function seo(?string $alias = null) : string
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
