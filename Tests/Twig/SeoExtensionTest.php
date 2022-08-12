<?php

namespace Leogout\Bundle\SeoBundle\Tests\Twig;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Provider\SeoGeneratorProvider;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Leogout\Bundle\SeoBundle\Tests\TestCase;
use Leogout\Bundle\SeoBundle\Twig\SeoExtension;
use Twig\Environment;
use Twig\Loader\ArrayLoader;

class SeoExtensionTest extends TestCase
{
    protected Environment $twig;
    protected SeoGeneratorProvider $provider;

    protected function setUp(): void
    {
        $loader = new ArrayLoader([
            'index' => '<!-- start -->{{ leogout_seo() }}<!-- end -->'
        ]);

        $tagBuilder = new TagBuilder(new TagFactory());
        $basicGenerator = new BasicSeoGenerator($tagBuilder);

        $this->provider = new SeoGeneratorProvider();

        $this->provider->set('basic', $basicGenerator);

        $this->twig = new Environment($loader);
        $this->twig->addExtension(new SeoExtension($this->provider));
    }

    public function testSeoTwigFunction()
    {
        $this->assertEquals('<!-- start --><!-- end -->', $this->twig->render('index'));

        /**
         * @var $basicSeo BasicSeoGenerator
         */
        $basicSeo = $this->provider->get('basic')->setTitle('example');

        $this->assertEquals('<!-- start --><title>example</title><!-- end -->',
            $this->twig->render('index'));

        $basicSeo->setDescription('it works!');

        $this->assertEquals('<!-- start --><title>example</title>' . PHP_EOL .
            '<meta name="description" content="it works!" /><!-- end -->', $this->twig->render('index'));
    }
}