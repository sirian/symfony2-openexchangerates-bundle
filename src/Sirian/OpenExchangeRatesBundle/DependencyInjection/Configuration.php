<?php

namespace Sirian\OpenExchangeRatesBundle\DependencyInjection;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $root = $treeBuilder->root('open_exchange_rates');

        $root
            ->children()
                ->scalarNode('app_id')->isRequired()->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
