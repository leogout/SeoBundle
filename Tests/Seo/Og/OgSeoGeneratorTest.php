<?php

namespace Leogout\Bundle\SeoBundle\Tests\Seo\Og;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Seo\Og\OgSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Og\OgSeoInterface;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of OgSeoGeneratorTest.
 *
 * @author: leogout
 */
class OgSeoGeneratorTest extends TestCase
{
    /**
     * @var OgSeoGenerator
     */
    protected $generator;

    protected function setUp()
    {
        $this->generator = new OgSeoGenerator(new TagBuilder(new TagFactory()));
    }

    public function testTitle()
    {
        $this->generator->setTitle('Awesome | Site');

        $this->assertEquals(
            '<meta name="og:title" content="Awesome | Site" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getTitle()
        );
    }

    public function testDescription()
    {
        $this->generator->setDescription('My awesome site is so cool!');

        $this->assertEquals(
            '<meta name="og:description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getDescription()
        );
    }

    public function testImage()
    {
        $this->generator->setImage('http://images.com/poney/12');

        $this->assertEquals(
            '<meta name="og:image" content="http://images.com/poney/12" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getImage()
        );
    }

    public function testType()
    {
        $this->generator->setType('website');

        $this->assertEquals(
            '<meta name="og:type" content="website" />',
            $this->generator->render()
        );
    }

    public function testFromResource()
    {
        $resource = $this->getMockBuilder(OgSeoInterface::class)->getMock();

        $resource->method('getSeoTitle')->willReturn('Awesome site');
        $resource->method('getSeoDescription')->willReturn('My awesome site is so cool!');
        $resource->method('getSeoImage')->willReturn('http://images.com/poney/12');

        $this->generator->fromResource($resource);

        $this->assertEquals(
            "<meta name=\"og:title\" content=\"Awesome site\" />\n".
            "<meta name=\"og:description\" content=\"My awesome site is so cool!\" />\n".
            "<meta name=\"og:image\" content=\"http://images.com/poney/12\" />",
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
