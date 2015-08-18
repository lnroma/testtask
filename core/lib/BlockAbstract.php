<?php
/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool core
 * @package lib
 *
 * class controller abstract run controller action and render block
 *
 * Class Core_Lib_ControllerAbstract
 */
class Core_Lib_BlockAbstract
{
    var $_controller = null;
    var $_template = null;
    private $_params = array();

    /**
     * render block
     * @return bool
     * @throws Exception
     */
    public function _toHtml() {
        $disegn = $this->_getDisegn();
        // get template file
        if(is_null($this->_controller)) {
            throw new Exception('Please set controller on block');
        }

        if(is_null($this->_template)) {
            throw new Exception('Please set name template for your block');
        }

        $filePuth = Core_Lib_Applet::getBaseDir().
            DIRECTORY_SEPARATOR.'disegn'.
            DIRECTORY_SEPARATOR.$disegn.
            DIRECTORY_SEPARATOR.'template'.
            DIRECTORY_SEPARATOR.$this->_controller.
            DIRECTORY_SEPARATOR.$this->_template.
            '.phtml';

        if(!file_exists($filePuth)) {
            throw new Exception(sprintf('Template file %s not exists',$filePuth));
        }

        include $filePuth;

        return true;
    }

    /**
     * get disegn
     * @return null
     * @throws Exception
     */
    protected function _getDisegn()
    {
        return Core_Lib_Applet::getConfig('config/disegn');
    }

    /**
     * set parameters for block
     * @param $key
     * @param $value
     */
    public function setParam($key,$value)
    {
        $this->_params[$key] = $value;
    }

    /**
     * get parameters for block
     * @param $key
     *
     * @return mixed
     * @throws Exception
     */
    public function getParam($key)
    {
        if(!isset($this->_params[$key])) {
            return null;
        }
        return $this->_params[$key];
    }
}