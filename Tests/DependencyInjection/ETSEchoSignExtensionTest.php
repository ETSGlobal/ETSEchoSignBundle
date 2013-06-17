<?php

namespace ETS\EchoSignBundle\Tests\DependencyInjection;


use ETS\EchoSignBundle\DependencyInjection\ETSEchoSignExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ETSEchoSignExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testRequiredParamsDefinition()
    {
        $container = new ContainerBuilder();
        $container->setParameter('kernel.cache_dir', __DIR__.'/');
        $config = array(
            'ets_echo_sign' => array(
                'api' => array(
                    'key' => 'API_KEY',
                    'gateway' => 'API_GATEWAY',
                    'wsdl' => 'API_WSDL'
                )
            )
        );
        $extension = new ETSEchoSignExtension();
        $extension->load($config, $container);

        $this->assertEquals('API_KEY', $container->getParameter('ets.echo.sign.api.key'));
        $this->assertEquals('API_GATEWAY', $container->getParameter('ets.echo.sign.api.gateway'));
        $this->assertEquals('API_WSDL', $container->getParameter('ets.echo.sign.api.wsdl'));
    }
}