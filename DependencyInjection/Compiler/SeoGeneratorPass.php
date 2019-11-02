<?php

namespace Leogout\Bundle\SeoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Description of SeoGeneratorPass.
 *
 * @author: leogout
 */
class SeoGeneratorPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('leogout_seo.provider.generator');
        $taggedServices = $container->findTaggedServiceIds('leogout_seo.generator');

        foreach ($taggedServices as $id => $tags) {
            $generatorDefinition = $container->getDefinition($id);
            if (!$generatorDefinition->isPublic()) {
                throw new \InvalidArgumentException(sprintf('Seo generator services must be public, but "%s" is not.', $id));
            }
            if ($generatorDefinition->isAbstract()) {
                throw new \InvalidArgumentException(sprintf('Seo generator services cannot be abstract but "%s" is.', $id));
            }
            foreach ($tags as $attributes) {
                if (empty($attributes['alias'])) {
                    throw new \InvalidArgumentException(sprintf('Tag "leogout_seo.generator" requires an "alias" field in "%s" definition.', $id));
                }

                $definition->addMethodCall('set', [$attributes['alias'], new Reference($id)]);
            }
        }
    }
}
