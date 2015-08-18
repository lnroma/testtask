<?php

/**
 * @autor roman naumov <family_89@mail.ru>
 *
 * this routing controller for render block
 *
 * @see Core_Lib_ControllerAbstract
 *
 * @package Shape
 * @codepool modules
 *
 * Class Shapes_Controller_IndexController
 */
class Shapes_Controller_IndexController extends Core_Lib_ControllerAbstract
{

    /**
     * render root puth
     *
     * @throws Exception
     */
    public function indexAction() {
        $block = Core_Lib_Applet::getBlock('shapes/show');
        $this
            ->setBlock($block)
            ->_render();
    }

    /**
     * pointshape action
     *
     * @throws Exception
     */
    public function pointshapeAction() {
        // set header content-type
        $this->_setHeader('Content-type','image/png');
        //create block and render
        $block = Core_Lib_Applet::getBlock('shapes/render');
        $this
            ->setBlock($block)
            ->_render();
    }
}