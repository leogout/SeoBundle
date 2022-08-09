<?php

namespace Leogout\Bundle\SeoBundle\Tests\Model;

use Leogout\Bundle\SeoBundle\Model\MetaTag;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

use InvalidArgumentException;

/**
 * Description of MetaTagTest.
 *
 * @author: leogout
 */
class MetaTagTest extends TestCase
{
    public function testNullValues()
    {
        $metaTag = new MetaTag();
        $this->assertNull($metaTag->getValue());
        $this->assertNull($metaTag->getContent());
    }

    public function testRenderName()
    {
        $metaTag = new MetaTag();
        $metaTag
            ->setType(MetaTag::NAME_TYPE)
            ->setValue('keywords')
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
            ->setValue('og:title')
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
            ->setValue('Cache-Control')
            ->setContent('no-cache');

        $this->assertEquals(
            '<meta http-equiv="Cache-Control" content="no-cache" />',
            $metaTag->render()
        );
    }

    public function testRenderNothing()
    {
        $metaTag = new MetaTag();

        $this->assertEquals(
            '<meta name="" content="" />',
            $metaTag->render()
        );
    }

    public function testSetUnknownType()
    {
        $this->expectException(InvalidArgumentException::class, sprintf('Meta tag of type "%s" doesn\'t exist. Existing types are: name, property and http-equiv.', 'unknownType'));

        $metaTag = new MetaTag();
        $metaTag->setType('unknownType');
    }
}
