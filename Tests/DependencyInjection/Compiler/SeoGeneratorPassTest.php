<?php

namespace Tests\Leogout\Bundle\SeoBundle\DependencyInjection\Compiler;

use Leogout\Bundle\SeoBundle\DependencyInjection\Compiler\SeoGeneratorPass;
use Leogout\Bundle\SeoBundle\Tests\TestCase;

/**
 * Description of SeoGeneratorPassTest.
 *
 * @author: leogout
 */
class SeoGeneratorPassTest extends TestCase
{
    private $containerBuilder;
    private $definition;
    private $builderDefinition;

    /**
     * @var SeoGeneratorPass
     */
    private $pass;

    protected function setUp()
    {
        $this->containerBuilder = $this->prophesize('Symfony\Component\DependencyInjection\ContainerBuilder');
        $this->definition = $this->prophesize('Symfony\Component\DependencyInjection\Definition');
        $this->builderDefinition = $this->prophesize('Symfony\Component\DependencyInjection\Definition');
        $this->pass = new SeoGeneratorPass();
        $this->containerBuilder->getDefinition('leogout_seo.provider.generator')->willReturn($this->definition);
        $this->containerBuilder->getDefinition('id')->willReturn($this->builderDefinition);
        $this->builderDefinition->isPublic()->willReturn(true);
        $this->builderDefinition->isAbstract()->willReturn(false);
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Seo generator services cannot be abstract but "id" is.
     */
    public function testFailsWhenServiceIsAbstract()
    {
        $this->builderDefinition->isAbstract()->willReturn(true);
        $this->containerBuilder->findTaggedServiceIds('leogout_seo.generator')->willReturn(['id' => [['alias' => 'foo']]]);
        $this->pass->process($this->containerBuilder->reveal());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Seo generator services must be public, but "id" is not.
     */
    public function testFailsWhenServiceIsPrivate()
    {
        $this->builderDefinition->isPublic()->willReturn(false);
        $this->containerBuilder->findTaggedServiceIds('leogout_seo.generator')->willReturn(['id' => [['alias' => 'foo']]]);
        $this->pass->process($this->containerBuilder->reveal());
    }

    /**
     * @expectedException \InvalidArgumentException
     * @expectedExceptionMessage Tag "leogout_seo.generator" requires an "alias" field in "id" definition.
     */
    public function testFailsWhenAliasIsMissing()
    {
        $this->containerBuilder->findTaggedServiceIds('leogout_seo.generator')->willReturn(['id' => [['alias' => '']]]);
        $this->pass->process($this->containerBuilder->reveal());
    }
}
