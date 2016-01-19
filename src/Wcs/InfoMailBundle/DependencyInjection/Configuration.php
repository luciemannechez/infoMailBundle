<?php

namespace Wcs\InfoMailBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('wcs_info_mail');

        $rootNode
            ->children()
                ->arrayNode('recipients')
                    ->children()
                        ->scalarNode('user_class')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode('mail_field')
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('uploads')
                    ->children()
                        ->scalarNode('directory')
                            ->defaultValue('uploads/infoMail')
                            ->cannotBeEmpty()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
