<?php

namespace Leogout\Bundle\SeoBundle;

use Leogout\Bundle\SeoBundle\DependencyInjection\Compiler\SeoGeneratorPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class LeogoutSeoBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new SeoGeneratorPass());
    }
}
