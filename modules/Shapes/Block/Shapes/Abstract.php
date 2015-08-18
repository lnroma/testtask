<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool modules
 * @package Shapes
 *
 * this abstract class for draw geometric figure on holst
 *
 * Class Shapes_Block_Shapes_Abstract
 */
class Shapes_Block_Shapes_Abstract extends Shapes_Block_Abstract
{

    /** @var null | resource */
    protected $_image = null;
    /** @var null | int */
    protected $_color = null;
    /** @var int | null */
    protected $_offset = null;
    /** @var null | int */
    protected $_x = null;
    /** @var null | int */
    protected $_y = null;
    /** @var null | int */
    protected $_x2 = null;
    /** @var null | int */
    protected $_y2 = null;
    /** @var array | boolean */
    protected $_figure = array();


    /**
     * constructor
     */
    public function __construct()
    {
        /** set default values */
        $this->_controller = 'shapes';
        $this->_template = 'render';
        $this->_offset = 0;
    }

    /**
     * initialization class
     */
    public function _init()
    {
        /** set values for draw pictures */
        $this->setY2($_POST['higth'][$this->getOffset()] + $_POST['y_position'][$this->getOffset()]);
        $this->setX2($_POST['width'][$this->getOffset()] + $_POST['x_position'][$this->getOffset()]);

        $this->setY1($_POST['higth'][$this->getOffset()]);
        $this->setX1($_POST['width'][$this->getOffset()]);

        $this->setImage();
        $this->setColor($_POST['red'][$this->getOffset()], $_POST['green'][$this->getOffset()], $_POST['blue'][$this->getOffset()]);
        $this->setFigure();
    }

    /**
     * set image resource for draw as singleton
     *
     * @param null $image
     * @return null|resource
     */
    public function setImage($image = null)
    {
        if (!is_null($image)) {
            $this->_image = $image;
        }

        if (!is_null($this->_image)) {
            return $this->_image;
        }

        $image = imagecreatetruecolor($_POST['size'][0], $_POST['size'][0]);
        $this->_image = $image;
    }

    /**
     * set Color for figure draw
     *
     * @param $red
     * @param $green
     * @param $blue
     *
     * @return $this
     */
    public function setColor($red, $green, $blue)
    {
        $color = imagecolorallocate($this->getImage(), $red, $green, $blue);
        $this->_color[$this->getOffset()] = $color;
        return $this;
    }

    /**
     * get collor
     *
     * @return int
     */
    public function getColor()
    {
        return $this->_color[$this->getOffset()];
    }

    /**
     * get x coordinate
     *
     * @return mixed
     */
    public function getX1()
    {
        return $this->_x[$this->getOffset()];
    }

    /**
     * set x coordinate
     *
     * @param $value
     */
    public function setX1($value)
    {
        $this->_x[$this->getOffset()] = $value;
    }

    /**
     * get Y coordinate
     *
     * @return mixed
     */
    public function getY1()
    {
        return $this->_y[$this->getOffset()];
    }

    /**
     * set Y coordinate
     *
     * @param $value
     */
    public function setY1($value)
    {
        $this->_y[$this->getOffset()] = $value;
    }

    /**
     * get X2 coordinate
     *
     * @return int
     */
    public function getX2()
    {
        return $this->_x2[$this->getOffset()];
    }

    /**
     * set X2 coordinate
     *
     * @param $value
     */
    public function setX2($value)
    {
        $this->_x2[$this->getOffset()] = $value;
    }

    /**
     * get Y2 coordinate
     *
     * @return int
     */
    public function getY2()
    {
        return $this->_y2[$this->getOffset()];
    }

    /**
     * set Y2 coordinate
     *
     * @param $value
     */
    public function setY2($value)
    {
        $this->_y2[$this->getOffset()] = $value;
    }

    /**
     * get image resource
     *
     * @return null|resource
     */
    public function getImage()
    {
        return $this->_image;
    }

    /**
     * set figure
     *
     * @return $this
     */
    protected function setFigure()
    {
        $this->_figure[$this->getOffset()] = imagefilledrectangle($this->getImage(), $this->getX1(), $this->getX2(), $this->getY1(), $this->getY2(), $this->getColor());
        return $this;
    }

    /**
     * get figure
     *
     * @return array|bool
     */
    public function getFigure()
    {
        return $this->_figure;
    }

    /**
     * set offset
     *
     * @param $ofset
     * @return mixed
     */
    public function setOffset($ofset)
    {
        return $this->_offset = $ofset;
    }

    /**
     * get offset
     *
     * @return int|null
     */
    public function getOffset()
    {
        return $this->_offset;
    }

}