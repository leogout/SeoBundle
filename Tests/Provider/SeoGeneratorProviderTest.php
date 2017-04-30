<?php

namespace Leogout\Bundle\SeoBundle\Tests\Seo\Basic;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Provider\SeoGeneratorProvider;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of SeoGeneratorProviderTest.
 *
 * @author: leogout
 */
class SeoGeneratorProviderTest extends TestCase
{
    /**
     * @var SeoGeneratorProvider
     */
    protected $provider;

    protected function setUp()
    {
        $tagBuilder = new TagBuilder(new TagFactory());
        $basicGenerator = new BasicSeoGenerator($tagBuilder);

        $this->provider = new SeoGeneratorProvider([
            'basic' => $basicGenerator,
        ]);
    }

    /**
     * @param
     */
    public function testGetGenerator()
    {
        $this->assertInstanceOf(
            BasicSeoGenerator::class,
            $this->provider->get('basic')
        );

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('The SEO generator with alias "undefined" is not defined.');
        $this->provider->get('undefined');
    }

    /**
     * @param
     */
    public function testHasGenerator()
    {
        $this->assertTrue(
            $this->provider->has('basic')
        );
        $this->assertFalse(
            $this->provider->has('undefined')
        );
    }
}
