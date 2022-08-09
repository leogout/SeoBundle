<?php

namespace Tests\Leogout\Bundle\SeoBundle\DependencyInjection\Compiler;

use Prophecy\PhpUnit\ProphecyTrait;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

use Leogout\Bundle\SeoBundle\DependencyInjection\Compiler\SeoGeneratorPass;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

use InvalidArgumentException;

/**
 * Description of SeoGeneratorPassTest.
 *
 * @author: leogout
 */
class SeoGeneratorPassTest extends TestCase
{
    use ProphecyTrait;

    private $containerBuilder;
    private $definition;
    private $builderDefinition;

    /**
     * @var SeoGeneratorPass
     */
    private $pass;

    protected function setUp(): void
    {
        $this->containerBuilder = $this->prophesize(ContainerBuilder::class);
        $this->definition = $this->prophesize(Definition::class);
        $this->builderDefinition = $this->prophesize(Definition::class);
        $this->pass = new SeoGeneratorPass();
        $this->containerBuilder->getDefinition('leogout_seo.provider.generator')->willReturn($this->definition);
        $this->containerBuilder->getDefinition('id')->willReturn($this->builderDefinition);
        $this->builderDefinition->isPublic()->willReturn(true);
        $this->builderDefinition->isAbstract()->willReturn(false);
    }

    public function testFailsWhenServiceIsAbstract()
    {
        $this->expectException(InvalidArgumentException::class, sprintf('Seo generator services cannot be %s but "%s" is.', 'abstract', 'id'));

        $this->builderDefinition->isAbstract()->willReturn(true);
        $this->containerBuilder->findTaggedServiceIds('leogout_seo.generator')->willReturn(['id' => [['alias' => 'foo']]]);
        $this->pass->process($this->containerBuilder->reveal());
    }

    public function testFailsWhenServiceIsPrivate()
    {
        $this->expectException(InvalidArgumentException::class, sprintf('Seo generator services cannot be %s but "%s" is.', 'public', 'id'));

        $this->builderDefinition->isPublic()->willReturn(false);
        $this->containerBuilder->findTaggedServiceIds('leogout_seo.generator')->willReturn(['id' => [['alias' => 'foo']]]);
        $this->pass->process($this->containerBuilder->reveal());
    }

    public function testFailsWhenAliasIsMissing()
    {
        $this->expectException(InvalidArgumentException::class, sprintf('Tag "%s" requires an "%s" field in "%s" definition.', 'leogout_seo.generator', 'alias', 'id'));

        $this->containerBuilder->findTaggedServiceIds('leogout_seo.generator')->willReturn(['id' => [['alias' => '']]]);
        $this->pass->process($this->containerBuilder->reveal());
    }
}
