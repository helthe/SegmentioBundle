<?php

/*
 * This file is part of the HeltheSegmentioBundle package.
 *
 * (c) Carl Alexander <carlalexander@helthe.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Helthe\Bundle\SegmentioBundle\Tests\DependencyInjection;

use Helthe\Bundle\SegmentioBundle\DependencyInjection\HeltheSegmentioExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class HeltheSegmentioExtensionTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException Symfony\Component\Config\Definition\Exception\InvalidConfigurationException
     */
    public function testWithNoWriteKey()
    {
        $container = new ContainerBuilder();
        $loader = new HeltheSegmentioExtension();
        $loader->load(array(array()), $container);
    }

    public function testLoadDefault()
    {
        $container = new ContainerBuilder();
        $loader = new HeltheSegmentioExtension();
        $loader->load(array(array('write_key' => 'segmentio_key')), $container);

        // HTTP Client
        $this->assertTrue($container->hasParameter('helthe_segmentio.http.client.class'));
        $this->assertEquals('GuzzleHttp\Client', $container->getParameter('helthe_segmentio.http.client.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.http.client'));

        // Segment.io
        $this->assertTrue($container->hasParameter('helthe_segmentio.client.class'));
        $this->assertEquals('Helthe\Component\Segmentio\Client', $container->getParameter('helthe_segmentio.client.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.client'));
        $this->assertEquals('segmentio_key', $container->getDefinition('helthe_segmentio.client')->getArgument(1));

        $this->assertTrue($container->hasParameter('helthe_segmentio.http_client.class'));
        $this->assertEquals('Helthe\Component\Segmentio\HttpClient', $container->getParameter('helthe_segmentio.http_client.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.http_client'));
        $this->assertEquals('segmentio_key', $container->getDefinition('helthe_segmentio.http_client')->getArgument(2));

        $this->assertTrue($container->hasParameter('helthe_segmentio.queue.class'));
        $this->assertEquals('Helthe\Component\Segmentio\Queue', $container->getParameter('helthe_segmentio.queue.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.queue'));

        // Templating
        $this->assertTrue($container->hasParameter('helthe_segmentio.templating.helper.class'));
        $this->assertEquals('Helthe\Component\Segmentio\Templating\Helper', $container->getParameter('helthe_segmentio.templating.helper.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.templating.helper'));

        $this->assertTrue($container->hasParameter('helthe_segmentio.templating.renderer.class'));
        $this->assertEquals('Helthe\Component\Segmentio\Templating\Renderer', $container->getParameter('helthe_segmentio.templating.renderer.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.templating.renderer'));

        // Twig
        $this->assertTrue($container->hasParameter('helthe_segmentio.twig.extension.segmentio.class'));
        $this->assertEquals('Helthe\Bundle\SegmentioBundle\Twig\SegmentioExtension', $container->getParameter('helthe_segmentio.twig.extension.segmentio.class'));
        $this->assertTrue($container->hasDefinition('helthe_segmentio.twig.extension.segmentio'));
        $this->assertTrue($container->getDefinition('helthe_segmentio.twig.extension.segmentio')->hasTag('twig.extension'));
    }
}
