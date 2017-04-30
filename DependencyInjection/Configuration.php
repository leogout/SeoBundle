<?php

namespace Leogout\Bundle\SeoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Description of Configuration.
 *
 * @author: leogout
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('leogout_seo');

        $rootNode->children()
            ->arrayNode('title')
                ->children()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->scalarNode('content')->isRequired()->end()
                    ->scalarNode('prefix')->defaultValue('')->end()
                    ->scalarNode('separator')->defaultValue('-')->end()
                ->end()
            ->end()
            ->arrayNode('description')
                ->children()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->scalarNode('content')->isRequired()->end()
                ->end()
            ->end()
            ->arrayNode('keywords')
                ->children()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->scalarNode('content')->isRequired()->end()
                ->end()
            ->end()
            ->arrayNode('robots')
                ->children()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->booleanNode('index')->defaultTrue()->end()
                    ->booleanNode('follow')->defaultTrue()->end()
                ->end()
            ->end()
            ->arrayNode('canonical')
                ->children()
                    ->booleanNode('enabled')->defaultTrue()->end()
                    ->scalarNode('url')->isRequired()->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
