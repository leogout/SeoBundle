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
                ->scalarNode('title')->end()
                ->scalarNode('description')->end()
                ->scalarNode('image')->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureBasicTree(ArrayNodeDefinition $rootNode)
    {
        $basicNode = $rootNode->children()->arrayNode('basic');
        $basicNode->children()
                ->scalarNode('title')->end()
                ->scalarNode('description')->end()
                ->scalarNode('keywords')->end()
                ->arrayNode('robots')
                    ->children()
                        ->booleanNode('index')->defaultTrue()->end()
                        ->booleanNode('follow')->defaultTrue()->end()
                    ->end()
                ->end()
                ->scalarNode('canonical')->end()
                ->scalarNode('paginate_previous')->end()
                ->scalarNode('paginate_next')->end()
            ->end();
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureOgTree(ArrayNodeDefinition $rootNode)
    {
        // According to the Open Graph Protocol only title, image, url and type are required on every page.
        // The other properties can be set either from the configuration or dynamically when needed.
        $ogNode = $rootNode->children()->arrayNode('og');
        $ogChildren = $ogNode->children()
                ->scalarNode('site_name')->end()
                ->scalarNode('title')->cannotBeEmpty()->end()
                ->scalarNode('description')->end()
                ->scalarNode('image')->cannotBeEmpty()->end()
                ->scalarNode('image_type')->end()
                ->scalarNode('image_width')->end()
                ->scalarNode('image_height')->end()
                ->scalarNode('image_secure_url')->end()
                ->scalarNode('image_alt')->end()
                ->scalarNode('type')->cannotBeEmpty()->end()
                ->scalarNode('url')->cannotBeEmpty()->end()
                ->scalarNode('audio')->end()
                ->scalarNode('audio_type')->end()
                ->scalarNode('audio_secure_url')->end()
                ->scalarNode('video')->end()
                ->scalarNode('video_type')->end()
                ->scalarNode('video_width')->end()
                ->scalarNode('video_height')->end()
                ->scalarNode('video_secure_url')->end()
                ->enumNode('determiner')
                    ->values(array('a', 'an', '', 'auto'))
                    ->defaultValue('')
                ->end()
                ->scalarNode('locale')->end();

        // The castToArray method was added in symfony 3.3, make sure we are not on an older version.
        // On older versions the user must specify an array.
        $altLocales = $ogChildren->arrayNode('alternate_locales');
        $exprBuilder = $altLocales->beforeNormalization();
        if (method_exists($exprBuilder, 'castToArray')) {
            $exprBuilder->castToArray()->end();
        }

        $ogChildren->end();
    }

    /**
     * @param ArrayNodeDefinition $rootNode
     */
    protected function configureTwitterTree(ArrayNodeDefinition $rootNode)
    {
        $twitterNode = $rootNode->children()->arrayNode('twitter');
        $twitterNode->children()
                ->scalarNode('title')->end()
                ->scalarNode('description')->end()
                ->scalarNode('image')->end()
                ->scalarNode('card')->end()
                ->scalarNode('site')->end()
            ->end();
    }





}
