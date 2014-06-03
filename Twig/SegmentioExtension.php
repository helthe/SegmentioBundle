<?php

/*
 * This file is part of the HeltheSegmentioBundle package.
 *
 * (c) Carl Alexander <carlalexander@helthe.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Helthe\Bundle\SegmentioBundle\Twig;

use Helthe\Component\Segmentio\Templating\Helper;

/**
 * Twig extension for Segment.io.
 *
 * @author Carl Alexander <carlalexander@helthe.co>
 */
class SegmentioExtension extends \Twig_Extension
{
    /**
     * Segment.io templating helper.
     *
     * @var Helper
     */
    private $helper;

    /**
     * Constructor.
     *
     * @param Renderer $helper
     */
    public function __construct(Helper $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Renders the alias method.
     *
     * @param string $newId
     * @param string $oldId
     *
     * @return string
     */
    public function alias($newId, $oldId = null)
    {
        return $this->helper->alias($newId, $oldId);
    }

    /**
     * Renders the asynchronous analytics.js loading script.
     *
     * @return string
     */
    public function asyncScript()
    {
        return $this->helper->asyncScript();
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('segmentio_alias', array($this, 'alias'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_async_script', array($this, 'asyncScript'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_identify', array($this, 'identify'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_init', array($this, 'init'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_load', array($this, 'load'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_page', array($this, 'page'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_queue', array($this, 'queue'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_render', array($this, 'render'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
            new \Twig_SimpleFunction('segmentio_track', array($this, 'track'), array('pre_escape' => 'html', 'is_safe' => array('html'))),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'helthe_segmentio';
    }

    /**
     * Renders the identify method.
     *
     * @param string $userId
     * @param array  $traits
     *
     * @return string
     */
    public function identify($userId, array $traits = array())
    {
        return $this->helper->identify($userId, $traits);
    }

    /**
     * Renders all the code necessary for initializing analytics.js.
     *
     * @return string
     */
    public function init()
    {
        return $this->helper->init();
    }

    /**
     * Renders the load method.
     *
     * @param string $key
     *
     * @return string
     */
    public function load($key)
    {
        return $this->helper->load($key);
    }

    /**
     * Renders the page method.
     *
     * @param string $category
     * @param string $name
     * @param array  $properties
     *
     * @return string
     */
    public function page($category = null, $name = null, array $properties = array())
    {
        return $this->helper->page($category, $name, $properties);
    }

    /**
     * Renders the method queue stored in the client.
     *
     * @return string
     */
    public function queue()
    {
        return $this->helper->queue();
    }

    /**
     * Renders all the analytics.js code.
     *
     * @return string
     */
    public function render()
    {
        return $this->helper->render();
    }

    /**
     * Renders the track method.
     *
     * @param string $event
     * @param array  $properties
     *
     * @return string
     */
    public function track($event, array $properties = array())
    {
        return $this->helper->track($event, $properties);
    }
}
