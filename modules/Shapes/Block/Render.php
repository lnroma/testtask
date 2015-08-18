<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool modules
 * @package Shapes
 *
 * this block render shapes
 *
 * Class Shapes_Block_Render
 */
class Shapes_Block_Render extends Shapes_Block_Abstract
{

    var $_image = null;

    /**
     * init block for render figures
     * @throws Exception
     */
    public function __construct()
    {
        $this->_controller = 'shapes';
        $this->_template = 'render';

        if (!isset($_POST['enable'])) {
            throw new Exception('Please enable shape');
        }

        foreach ($_POST['enable'] as $_key => $_value) {
            /** @var Shapes_Block_Shapes_Round $block */
            if ($_value == '') {
                continue;
            }
            $block = Core_Lib_Applet::getBlock('shapes/shapes/' . $_POST['shapes'][$_key]);
            $block = new $block;
            $block->setImage($this->_image);
            $block->setOffset($_key);
            $block->_init();
            $this->_image = $block->getImage();
        }
    }

    /**
     * render shape
     */
    public function renderShape()
    {
        imagepng($this->_image);
        imagedestroy($this->_image);
    }

}