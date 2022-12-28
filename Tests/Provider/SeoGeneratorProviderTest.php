<?php

namespace Leogout\Bundle\SeoBundle\Tests\Provider;

use Leogout\Bundle\SeoBundle\Builder\TagBuilder;
use Leogout\Bundle\SeoBundle\Factory\TagFactory;
use Leogout\Bundle\SeoBundle\Provider\SeoGeneratorProvider;
use Leogout\Bundle\SeoBundle\Seo\Basic\BasicSeoGenerator;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

use InvalidArgumentException;

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
    protected SeoGeneratorProvider $provider;

    protected function setUp(): void
    {
        $tagBuilder = new TagBuilder(new TagFactory());
        $basicGenerator = new BasicSeoGenerator($tagBuilder);

        $this->provider = new SeoGeneratorProvider();

        $this->provider->set('basic', $basicGenerator);
    }

    public function testGetGenerator()
    {
        $this->assertInstanceOf(
            BasicSeoGenerator::class,
            $this->provider->get('basic')
        );
    }

    public function testGetUndefinedGenerator()
    {
        $this->expectException(InvalidArgumentException::class, sprintf('The SEO generator with alias "%s" is not defined.', 'undefined'));
        $this->provider->get('undefined');
    }

    public function testGetAllGenerators()
    {
        $this->assertInstanceOf(
            BasicSeoGenerator::class,
            $this->provider->getAll()['basic']
        );
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
