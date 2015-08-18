<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool modules
 * @package Shapes
 *
 * class create cube or over rectangle figure
 *
 * Class Shapes_Block_Shapes_Cube
 */
class Shapes_Block_Shapes_Cube extends Shapes_Block_Shapes_Abstract
{

    /**
     * rewrite method for set figure
     */
    public function setFigure()
    {
        imagerectangle($this->getImage(), $this->getX1(), $this->getY1(), $this->getX2(), $this->getY2(), $this->getColor());
    }

}