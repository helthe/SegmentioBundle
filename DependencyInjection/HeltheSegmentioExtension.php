<?php

/*
 * This file is part of the HeltheSegmentioBundle package.
 *
 * (c) Carl Alexander <carlalexander@helthe.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Helthe\Bundle\SegmentioBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages HeltheSegmentioBundle configuration.
 *
 * @author Carl Alexander <carlalexander@helthe.co>
 */
class HeltheSegmentioExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('http.xml');
        $loader->load('segmentio.xml');
        $loader->load('templating.xml');
        $loader->load('twig.xml');

        $container->getDefinition('helthe_segmentio.client')->replaceArgument(1, $config['write_key']);
        $container->getDefinition('helthe_segmentio.http_client')->replaceArgument(2, $config['write_key']);
    }
}
