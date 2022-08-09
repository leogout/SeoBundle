<?php

namespace Leogout\Bundle\SeoBundle\Tests\Seo\Twitter;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoGenerator;
use Leogout\Bundle\SeoBundle\Seo\Twitter\TwitterSeoInterface;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of TwitterSeoGeneratorTest.
 *
 * @author: leogout
 */
class TwitterSeoGeneratorTest extends TestCase
{
    /**
     * @var TwitterSeoGenerator
     */
    protected TwitterSeoGenerator $generator;

    protected function setUp(): void
    {
        $this->generator = new TwitterSeoGenerator(new TagBuilder(new TagFactory()));
    }

    public function testTitle()
    {
        $this->assertNull($this->generator->getTitle());

        $this->generator->setTitle('Awesome | Site');

        $this->assertEquals(
            '<meta name="twitter:title" content="Awesome | Site" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getTitle()
        );
    }

    public function testDescription()
    {
        $this->assertNull($this->generator->getDescription());

        $this->generator->setDescription('My awesome site is so cool!');

        $this->assertEquals(
            '<meta name="twitter:description" content="My awesome site is so cool!" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getDescription()
        );
    }

    public function testImage()
    {
        $this->assertNull($this->generator->getImage());

        $this->generator->setImage('https://example.com/poney/12');

        $this->assertEquals(
            '<meta name="twitter:image" content="https://example.com/poney/12" />',
            $this->generator->render()
        );

        $this->assertInstanceOf(
            MetaTag::class, $this->generator->getImage()
        );
    }

    public function testCard()
    {
        $this->assertNull($this->generator->getCard());

        $this->generator->setCard('summary');

        $this->assertEquals(
            '<meta name="twitter:card" content="summary" />',
            $this->generator->render()
        );
    }

    public function testSite()
    {
        $this->assertNull($this->generator->getSite());

        $this->generator->setSite('@leogoutt');

        $this->assertEquals(
            '<meta name="twitter:site" content="@leogoutt" />',
            $this->generator->render()
        );
    }

    public function testFromResource()
    {
        $resource = $this->getMockBuilder(TwitterSeoInterface::class)->getMock();

        $resource->method('getSeoTitle')->willReturn('Awesome site');
        $resource->method('getSeoDescription')->willReturn('My awesome site is so cool!');
        $resource->method('getSeoImage')->willReturn('https://example.com/poney/12');

        $this->generator->fromResource($resource);

        $this->assertEquals(
            "<meta name=\"twitter:title\" content=\"Awesome site\" />\n".
            "<meta name=\"twitter:description\" content=\"My awesome site is so cool!\" />\n".
            "<meta name=\"twitter:image\" content=\"https://example.com/poney/12\" />",
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
