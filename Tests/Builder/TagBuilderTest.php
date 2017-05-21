<?php

namespace Leogout\Bundle\SeoBundle\Tests\Builder;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of TagBuilderTest.
 *
 * @author: leogout
 */
class TagBuilderTest extends TestCase
{
    /**
     * @var TagBuilder
     */
    protected $tagBuilder;

    protected function setUp()
    {
        $this->tagBuilder = new TagBuilder(new TagFactory());
    }

    public function testRenderAll()
    {
        $this->tagBuilder->setTitle('Awesonme | Site');
        $this->tagBuilder->addMeta('keywords', MetaTag::NAME_TYPE, 'keywords', 'your, tags');
        $this->tagBuilder->addLink('rss',
            'http://symfony.com/blog',
            'alternate',
            'application/rss+xml',
            'RSS'
        );

        $this->assertEquals(
            "<title>Awesonme | Site</title>\n".
            "<meta name=\"keywords\" content=\"your, tags\" />\n".
            "<link href=\"http://symfony.com/blog\" rel=\"alternate\" type=\"application/rss+xml\" title=\"RSS\" />",
            $this->tagBuilder->render()
        );
    }

    public function testRenderTitle()
    {
        $this->tagBuilder->setTitle('Awesonme | Site');

        $this->assertEquals(
            '<title>Awesonme | Site</title>',
            $this->tagBuilder->render()
        );
    }

    public function testRenderMeta()
    {
        $this->tagBuilder->addMeta('keywords', MetaTag::NAME_TYPE, 'keywords', 'your, tags');

        $this->assertEquals(
            '<meta name="keywords" content="your, tags" />',
            $this->tagBuilder->render()
        );
    }

    public function testRenderLink()
    {
        $this->tagBuilder->addLink('rss',
            'http://symfony.com/blog',
            'alternate',
            'application/rss+xml',
            'RSS'
        );

        $this->assertEquals(
            '<link href="http://symfony.com/blog" rel="alternate" type="application/rss+xml" title="RSS" />',
            $this->tagBuilder->render()
        );
    }

    public function testRenderNothing()
    {
        $this->assertEquals(
            '',
            $this->tagBuilder->render()
        );
    }
}
