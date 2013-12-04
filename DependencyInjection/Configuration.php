<?php

namespace Betacie\Bundle\MangoPayBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{

    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode    = $treeBuilder->root('betacie_mango_pay');

        $rootNode
            ->children()
            ->scalarNode('partner_id')->isRequired()->end()
            ->scalarNode('private_key_file')->isRequired()->end()
            ->scalarNode('private_key_passphrase')->isRequired()->end()
            ->scalarNode('url')->isRequired()->end()
            ->end()
        ;

        return $treeBuilder;
    }

}
