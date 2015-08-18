<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool modules
 * @package Shapes
 *
 * class create shape ellipse
 *
 * Class Shapes_Block_Shapes_Round
 */
class Shapes_Block_Shapes_Round extends Shapes_Block_Shapes_Abstract
{

    /**
     * rewrite setFigure method for set ellipse
     */
    public function setFigure()
    {
        imageellipse($this->getImage(), $this->getX1(), $this->getY1(), $this->getX2(), $this->getY2(), $this->getColor());
    }

}