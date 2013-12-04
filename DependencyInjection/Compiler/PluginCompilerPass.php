<?php

namespace Betacie\Bundle\MangoPayBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\Reference;

class PluginCompilerPass implements CompilerPassInterface
{

    public function process(ContainerBuilder $container)
    {
        if (!$container->hasDefinition('betacie_mango_pay.client')) {
            return;
        }

        $definition = $container->getDefinition(
            'betacie_mango_pay.client'
        );

        $taggedServices = $container->findTaggedServiceIds(
            'betacie_mango_pay.plugin'
        );
        foreach ($taggedServices as $id => $attributes) {
            $definition->addMethodCall(
                'addSubscriber', array(new Reference($id))
            );
        }
    }

}