<?php

namespace Leogout\Bundle\SeoBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
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

        $this->configureGeneralTree($rootNode);
        $this->configureBasicTree($rootNode);
        $this->configureOgTree($rootNode);
        $this->configureTwitterTree($rootNode);

        return $treeBuilder;
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureGeneralTree(ArrayNodeDefinition $rootNode)
    {
        $generalNode = $rootNode->children()->arrayNode('general');
        $generalNode->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('image')->cannotBeEmpty()->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureBasicTree(ArrayNodeDefinition $rootNode)
    {
        $basicNode = $rootNode->children()->arrayNode('basic');
        $basicNode->children()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('keywords')->cannotBeEmpty()->end()
                ->arrayNode('robots')
                    ->children()
                        ->booleanNode('index')->defaultTrue()->end()
                        ->booleanNode('follow')->defaultTrue()->end()
                    ->end()
                ->end()
                ->scalarNode('canonical')->cannotBeEmpty()->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureOgTree(ArrayNodeDefinition $rootNode)
    {
        $ogNode = $rootNode->children()->arrayNode('og');
        $ogNode->children()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('image')->cannotBeEmpty()->end()
                ->scalarNode('type')->cannotBeEmpty()->end()
                ->scalarNode('url')->cannotBeEmpty()->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureTwitterTree(ArrayNodeDefinition $rootNode)
    {
        $twitterNode = $rootNode->children()->arrayNode('twitter');
        $twitterNode->children()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('description')->cannotBeEmpty()->end()
                ->scalarNode('image')->cannotBeEmpty()->end()
                ->scalarNode('card')->cannotBeEmpty()->end()
                ->scalarNode('site')->cannotBeEmpty()->end()
            ->end();
    }





}
