<?php

namespace Wbi\Api\UserBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('wbi_api_user');

        $rootNode
            ->children()
                ->arrayNode('oauth2')
                    ->children()
                        ->arrayNode('client')
                            ->children()
                                ->scalarNode('name')->end()
                                ->scalarNode('redirecturi')->end()
                                ->arrayNode('grant_types')
                                    ->prototype('scalar')->end()
                                ->end()
                            ->end()
                         ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
