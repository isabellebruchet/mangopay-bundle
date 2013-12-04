<?php

namespace Betacie\Bundle\MangoPayBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BetacieMangoPayExtension extends Extension
{

    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config        = $this->processConfiguration($configuration, $configs);

        foreach (array('partner_id', 'private_key_file', 'private_key_passphrase', 'url') as $key) {
            $container->setParameter('betacie_mango_pay.' . $key, $config[$key]);
        }

        $loader = new Loader\XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));

        foreach (array('services', 'orm') as $name) {
            $loader->load($name . '.xml');
        }
    }

}
