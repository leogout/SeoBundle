<?php

namespace Leogout\Bundle\SeoBundle\Tests\Seo\Twitter;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Seo\Og\OgSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoConfigurator;
use Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

use Leogout\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException;

/**
 * Description of TwitterSeoConfiguratorTest.
 *
 * @author: leogout
 */
class TwitterSeoConfiguratorTest extends TestCase
{
    /**
     * @var TwitterSeoGenerator
     */
    protected $generator;

    protected function setUp(): void
    {
        $this->generator = new TwitterSeoGenerator(new TagBuilder(new TagFactory()));
    }

    public function testException()
    {
        $this->expectException(InvalidSeoGeneratorException::class, sprintf('Invalid seo generator passed to %s. Expected "%s", but got "%s".', 
            TwitterSeoConfigurator::class, TwitterSeoGenerator::class, OgSeoGenerator::class));

        $invalidGenerator = new OgSeoGenerator(new TagBuilder(new TagFactory()));
        $configurator = new TwitterSeoConfigurator([]);
        $configurator->configure($invalidGenerator);
    }

    public function testTitle()
    {
        $config = [
            'title' => 'Awesome | Site'
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:title" content="Awesome | Site" />',
            $this->generator->render()
        );
    }

    public function testDescription()
    {
        $config = [
            'description' => 'My awesome site is so cool!',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );
    }

    public function testImage()
    {
        $config = [
            'image' => 'https://example.com/poney/12',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:image" content="https://example.com/poney/12" />',
            $this->generator->render()
        );
    }

    public function testCard()
    {
        $config = [
            'card' => 'summary',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:card" content="summary" />',
            $this->generator->render()
        );
    }

    public function testSite()
    {
        $config = [
            'site' => '@leogoutt',
        ];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="twitter:site" content="@leogoutt" />',
            $this->generator->render()
        );
    }

    public function testNoConfig()
    {
        $config = [];

        $configurator = new TwitterSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '',
            $this->generator->render()
        );
    }
}
