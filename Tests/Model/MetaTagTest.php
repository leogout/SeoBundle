<?php

namespace Leogout\Bundle\SeoBundle\Tests\Model;

use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of MetaTagTest.
 *
 * @author: leogout
 */
class MetaTagTest extends TestCase
{
    public function testRenderName()
    {
        $metaTag = new MetaTag();
        $metaTag
            ->setType(MetaTag::NAME_TYPE)
            ->setTagName('keywords')
            ->setContent('your, tags');

        $this->assertEquals(
            '<meta name="keywords" content="your, tags" />',
            $metaTag->render()
        );
    }

    public function testRenderProperty()
    {
        $metaTag = new MetaTag();
        $metaTag
            ->setType(MetaTag::PROPERTY_TYPE)
            ->setTagName('og:title')
            ->setContent('My awesome site');

        $this->assertEquals(
            '<meta property="og:title" content="My awesome site" />',
            $metaTag->render()
        );
    }

    public function testRenderHttpEquiv()
    {
        $metaTag = new MetaTag();
        $metaTag
            ->setType(MetaTag::HTTP_EQUIV_TYPE)
            ->setTagName('Cache-Control')
            ->setContent('no-cache');

        $this->assertEquals(
            '<meta http-equiv="Cache-Control" content="no-cache" />',
            $metaTag->render()
        );
    }

    public function testRenderEmptyString()
    {
        $metaTag = new MetaTag();
        $metaTag
            ->setType(MetaTag::PROPERTY_TYPE)
            ->setTagName('og:determiner')
            ->setContent('')
        ;

        // This is a valid use case, according to the opengraph specs an empty string is a valid value for determiner.
        $this->assertEquals(
            '<meta property="og:determiner" content="" />',
            $metaTag->render()
        );
    }

    public function testRenderNothing()
    {
        $metaTag = new MetaTag();

        $this->assertEquals('', $metaTag->render());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Meta tag of type "unknownType" doesn't exist. Existing types are: name, property and http-equiv.
     */
    public function testSetUnknownType()
    {
        $metaTag = new MetaTag();
        $metaTag->setType('unknownType');
    }
}
