<?php

namespace Leogout\Bundle\SeoBundle\Tests\Seo\Basic;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoConfigurator;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of BasicSeoConfiguratorTest.
 *
 * @author: leogout
 */
class BasicSeoConfiguratorTest extends TestCase
{
    /**
     * @var BasicSeoGenerator
     */
    protected $generator;

    protected function setUp()
    {
        $this->generator = new BasicSeoGenerator(new TagBuilder(new TagFactory()));
    }

    /**
     * @expectedException \Leogout\Bundle\SeoBundle\Exception\InvalidSeoGeneratorException
     * @expectedExceptionMessage Invalid seo generator passed to Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoConfigurator. Expected "Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator", but got "Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator".
     */
    public function testException()
    {
        $invalidGenerator = new TwitterSeoGenerator(new TagBuilder(new TagFactory()));
        $configurator = new BasicSeoConfigurator([]);
        $configurator->configure($invalidGenerator);
    }

    public function testTitle()
    {
        $config = [
            'title' => 'Awesome | Site'
        ];

        $configurator = new BasicSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<title>Awesome | Site</title>',
            $this->generator->render()
        );
    }

    public function testDescription()
    {
        $config = [
            'description' => 'My awesome site is so cool!',
        ];

        $configurator = new BasicSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );
    }

    public function testKeywords()
    {
        $config = [
            'keywords' => 'awesome, cool',
        ];

        $configurator = new BasicSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="keywords" content="awesome, cool" />',
            $this->generator->render()
        );
    }

    public function testCanonical()
    {
        $config = [
            'canonical' => 'http://127.0.0.1:8000',
        ];

        $configurator = new BasicSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<link href="http://127.0.0.1:8000" rel="canonical" />',
            $this->generator->render()
        );
    }

    public function testRobots()
    {
        $config = [
            'robots' => [
                'index' => true,
                'follow' => true,
            ],
        ];

        $configurator = new BasicSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '<meta name="robots" content="index, follow" />',
            $this->generator->render()
        );
    }

    public function testNoConfig()
    {
        $config = [];

        $configurator = new BasicSeoConfigurator($config);
        $configurator->configure($this->generator);

        $this->assertEquals(
            '',
            $this->generator->render()
        );
    }
}
