<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool modules
 * @package Shapes
 *
 * this common class for declaration template
 *
 * Class Shapes_Block_Abstract
 */
class Shapes_Block_Abstract extends Core_Lib_BlockAbstract
{

    /**
     * initialization class
     */
    public function __construct()
    {
        $this->_controller = 'shapes';
    }

}