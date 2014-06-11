<?php
/*
 * Copyright 2012 ETSGlobal <ecs@etsglobal.org>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace ETS\EchoSignBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree builder.
     *
     * @return \Symfony\Component\Config\Definition\Builder\TreeBuilder The tree builder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();

        return $treeBuilder
            ->root('ets_echo_sign')
                ->children()
                    ->arrayNode('api')
                        ->children()
                            ->scalarNode('key')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('gateway')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                            ->scalarNode('wsdl')
                                ->isRequired()
                                ->cannotBeEmpty()
                            ->end()
                        ->end()
                    ->end()
                    ->arrayNode('debug')
                        ->addDefaultsIfNotSet()
                        ->children()
                            ->scalarNode('prefix')->defaultNull()->end()
                        ->end()
                    ->end()
                    ->arrayNode('recipients')
                        ->isRequired()
                        ->requiresAtLeastOneElement()
                        ->cannotBeEmpty()
                        ->prototype('scalar')
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;
    }
}
