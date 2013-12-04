<?php

namespace Betacie\Bundle\MangoPayBundle;

use Betacie\Bundle\MangoPayBundle\DependencyInjection\Compiler\PluginCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class BetacieMangoPayBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new PluginCompilerPass());
    }    
}
