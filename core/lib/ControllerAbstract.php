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
class Core_Lib_ControllerAbstract
{
    /** @var array  */
    private $_block = array();

    /**
     * init controller
     */
    public function __construct()
    {
        if (isset($_GET['action'])) {
            $action = $_GET['action'];
        } else {
            $action = null;
        }
        $this->_actionRun($action);
    }

    /**
     * run action
     * @param null $actionName
     */
    protected function _actionRun($actionName = null)
    {
        if ($actionName == null) {
            $actionName = 'index';
        }

        $methodName = $actionName . 'Action';
        $this->$methodName();
    }


    /**
     * @param $blockKey
     *
     * @return Core_Lib_ControllerAbstract
     * @throws Exception
     */
    protected function _setChunk($blockKey)
    {
        $this->_getBlock($blockKey);
        return $this;
    }

    /**
     * set block class
     *
     * @param $blockClass
     *
     * @return mixed
     */
    public function setBlock($blockClass)
    {
        $this->_block['block'][] = $blockClass;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     *
     * @return mixed
     */
    public function setParamToBlock($key, $value)
    {
        $this->_block['param'][][$key] = $value;
        return $this;
    }

    /**
     * get all blocks for rerder
     * @return array
     */
    public function getAllBlocks()
    {
        return $this->_block['block'];
    }

    /**
     * get params for block
     * @return mixed
     */
    protected function _getParamBlock()
    {
        if(!isset($this->_block['param'])) {
            return null;
        }

        return $this->_block['param'];
    }

    /**
     * render block
     * @throws Exception
     */
    protected function _render()
    {
        /** @var Core_Lib_BlockAbstract $blockInstance */
        $blockClass = $this->getAllBlocks();
        $blockParam = $this->_getParamBlock();

        if (is_null($blockClass)) {
            throw new Exception('block do not set please set block');
        }

        for ($i = 0; $i < count($blockClass); $i++) {
            $blockInstance = new $blockClass[$i];

            if(!is_null($blockParam)) {
                $key = array_keys($blockParam[$i])[0];
                $blockInstance->setParam($key, $blockParam[$i][$key]);
            }

            $blockInstance->_toHtml();
        }
    }


    /**
     * set header information
     * @param $key
     * @param $value
     */
    protected function _setHeader($key, $value)
    {
        header(sprintf("%s:%s", $key, $value));
    }

}