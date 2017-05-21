<?php

namespace Leogout\Bundle\SeoBundle\Tests\Seo\Basic;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Model\TitleTag;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoInterface;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of BasicSeoGeneratorTest.
 *
 * @author: leogout
 */
class BasicSeoGeneratorTest extends TestCase
{
    /**
     * @var BasicSeoGenerator
     */
    protected $generator;

    protected function setUp()
    {
        $this->generator = new BasicSeoGenerator(new TagBuilder(new TagFactory()));
    }

    public function testTitle()
    {
        $this->generator->setTitle('Awesome site');

        $this->assertEquals(
            '<title>Awesome site</title>',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            TitleTag::class, $this->generator->getTitle()
        );
    }

    public function testDescription()
    {
        $this->generator->setDescription('My awesome site is so cool!');

        $this->assertEquals(
            '<meta name="description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getDescription()
        );
    }

    public function testKeywords()
    {
        $this->generator->setKeywords('awesome, cool');

        $this->assertEquals(
            '<meta name="keywords" content="awesome, cool" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getKeywords()
        );
    }

    public function testCanonical()
    {
        $this->generator->setCanonical('http://127.0.0.1:8000');

        $this->assertEquals(
            '<link href="http://127.0.0.1:8000" rel="canonical" />',
            $this->generator->render()
        );
    }

    public function testRobots()
    {
        $this->generator->setRobots(true, true);

        $this->assertEquals(
            '<meta name="robots" content="index, follow" />',
            $this->generator->render()
        );

        $this->generator->setRobots(false, false);

        $this->assertEquals(
            '<meta name="robots" content="noindex, nofollow" />',
            $this->generator->render()
        );

        $this->generator->setRobots(true, false);

        $this->assertEquals(
            '<meta name="robots" content="index, nofollow" />',
            $this->generator->render()
        );

        $this->generator->setRobots(false, true);

        $this->assertEquals(
            '<meta name="robots" content="noindex, follow" />',
            $this->generator->render()
        );
    }

    public function testFromResource()
    {
        $resource = $this->getMockBuilder(BasicSeoInterface::class)->getMock();

        $resource->method('getSeoTitle')->willReturn('Awesome site');
        $resource->method('getSeoDescription')->willReturn('My awesome site is so cool!');
        $resource->method('getSeoKeywords')->willReturn('awesome, cool');

        $this->generator->fromResource($resource);

        $this->assertEquals(
            "<title>Awesome site</title>\n".
            "<meta name=\"description\" content=\"My awesome site is so cool!\" />\n".
            "<meta name=\"keywords\" content=\"awesome, cool\" />",
            $this->generator->render()
        );
    }

    public function testRenderNothing()
    {
        $this->assertEquals(
            '',
            $this->generator->render()
        );
    }
}
