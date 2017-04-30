<?php

namespace Leogout\Bundle\SeoBundle\Tests\Model;

use Leogout\Bundle\SeoBundle\Model\LinkTag;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of LinkTagTest.
 *
 * @author: leogout
 */
class LinkTagTest extends TestCase
{
    public function testRenderAll()
    {
        $linkTag = new LinkTag();
        $linkTag
            ->setHref('http://symfony.com/blog')
            ->setRel('alternate')
            ->setType('application/rss+xml')
            ->setTitle('RSS');

        $this->assertEquals(
            '<link href="http://symfony.com/blog" rel="alternate" type="application/rss+xml" title="RSS" />',
            $linkTag->render()
        );
    }

    public function testRenderHrefAndRel()
    {
        $linkTag = new LinkTag();
        $linkTag
            ->setHref('http://symfony.com/blog')
            ->setRel('alternate');

        $this->assertEquals(
            '<link href="http://symfony.com/blog" rel="alternate" />',
            $linkTag->render()
        );
    }

    public function testRenderTypeAndTitle()
    {
        $linkTag = new LinkTag();
        $linkTag
            ->setType('application/rss+xml')
            ->setTitle('RSS');

        $this->assertEquals(
            '<link type="application/rss+xml" title="RSS" />',
            $linkTag->render()
        );
    }

    public function testRenderNothing()
    {
        $linkTag = new LinkTag();
        $this->assertEquals(
            '<link />',
            $linkTag->render()
        );
    }
}
