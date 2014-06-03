<?php

/*
 * This file is part of the HeltheSegmentioBundle package.
 *
 * (c) Carl Alexander <carlalexander@helthe.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Helthe\Bundle\SegmentioBundle\Tests\Twig;

use Helthe\Bundle\SegmentioBundle\Twig\SegmentioExtension;
use Helthe\Component\Segmentio\Templating\Helper;

class SegmentioExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function testAlias()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('alias')
               ->with($this->equalTo('foo_id'), $this->equalTo('bar_id'))
               ->will($this->returnValue('window.analytics.alias("foo_id","bar_id");'));

        $this->assertEquals('window.analytics.alias("foo_id","bar_id");', $this->getTemplate('{{ segmentio_alias(newId, oldId) }}', $helper)->render(array('newId' => 'foo_id', 'oldId' => 'bar_id')));
    }

    public function testAsyncScript()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('asyncScript')
               ->will($this->returnValue('window.analytics;'));

        $this->assertEquals('window.analytics;', $this->getTemplate('{{ segmentio_async_script() }}', $helper)->render(array()));
    }

    public function testIdentify()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('identify')
               ->with($this->equalTo('foo_id'), $this->equalTo(array()))
               ->will($this->returnValue('window.analytics.identify("foo_id",[]);'));

        $this->assertEquals('window.analytics.identify("foo_id",[]);', $this->getTemplate('{{ segmentio_identify(userId) }}', $helper)->render(array('userId' => 'foo_id')));
    }

    public function testInit()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('init')
               ->will($this->returnValue('window.analytics;'));

        $this->assertEquals('window.analytics;', $this->getTemplate('{{ segmentio_init() }}', $helper)->render(array()));
    }

    public function testLoad()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('load')
               ->with($this->equalTo('foo_key'))
               ->will($this->returnValue('window.analytics.load("foo_key");'));

        $this->assertEquals('window.analytics.load("foo_key");', $this->getTemplate('{{ segmentio_load(key) }}', $helper)->render(array('key' => 'foo_key')));
    }

    public function testPage()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('page')
               ->with($this->equalTo(null), $this->equalTo(null), $this->equalTo(array()))
               ->will($this->returnValue('window.analytics.page();'));

        $this->assertEquals('window.analytics.page();', $this->getTemplate('{{ segmentio_page() }}', $helper)->render(array()));
    }

    public function testQueue()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('queue')
               ->will($this->returnValue('window.analytics;'));

        $this->assertEquals('window.analytics;', $this->getTemplate('{{ segmentio_queue() }}', $helper)->render(array()));
    }

    public function testRender()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('render')
               ->will($this->returnValue('window.analytics;'));

        $this->assertEquals('window.analytics;', $this->getTemplate('{{ segmentio_render() }}', $helper)->render(array()));
    }

    public function testTrack()
    {
        $helper = $this->getHelperMock();
        $helper->expects($this->once())
               ->method('track')
               ->with($this->equalTo('foo'), $this->equalTo(array()))
               ->will($this->returnValue('window.analytics.track("foo",[]);'));

        $this->assertEquals('window.analytics.track("foo",[]);', $this->getTemplate('{{ segmentio_track(event) }}', $helper)->render(array('event' => 'foo')));
    }

    /**
     * Get a mock of the Segment.io client.
     *
     * @return PHPUnit_Framework_MockObject_MockObject
     */
    private function getHelperMock()
    {
        return $this->getMockBuilder('Helthe\Component\Segmentio\Templating\Helper')
                    ->disableOriginalConstructor()
                    ->getMock();
    }

    /**
     * @param string $template
     * @param Helper $helper
     *
     * @return \Twig_Template
     */
    private function getTemplate($template, $helper)
    {
        $loader = new \Twig_Loader_Array(array('index' => $template));
        $twig = new \Twig_Environment($loader, array('debug' => true, 'cache' => false));
        $twig->addExtension(new SegmentioExtension($helper));

        return $twig->loadTemplate('index');
    }
}
