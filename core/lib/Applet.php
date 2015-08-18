<?php

/**
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool core
 * @package lib
 *
 * Is main class application
 *
 * Class Core_Lib_Applet
 */
class Core_Lib_Applet
{
    static private $_baseDir = null;
    static private $_configuration = null;
    /** @var Core_Lib_Autoloader */
    static private $autoloader = null;

    /**
     * get base dirr applet
     * @return null
     * @throws Exception
     */
    static public function getBaseDir()
    {
        if (!is_null(self::$_baseDir)) {
            return self::$_baseDir;
        } else {
            throw new Exception('Error base dir not set');
        }
    }

    /**
     * set base dirr puth
     *
     * @param $dirPuth
     *
     * @return null
     */
    static public function setBaseDir($dirPuth)
    {
        self::$_baseDir = $dirPuth;
        return self::$_baseDir;
    }

    /**
     * run applet
     * @throws Exception
     */
    static public function run()
    {
        if (is_null(self::$_baseDir)) {
            throw new Exception('Error base dir not set');
        }

        include self::$_baseDir . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . 'Autoloader.php';
        self::$autoloader = new Core_Lib_Autoloader();

        //initialize applet controller
        self::_getInstanceController();
    }

    /**
     * get instance class controller
     * @return bool
     * @throws Exception
     */
    static private function _getInstanceController()
    {
        if (!isset($_GET['controller'])) {
            $rout[0] = 'default';
        } else {
            $rout = explode('_', $_GET['controller']);
        }

        if (count($rout) == 1) {
            $rout[1] = 'index';
        }

        $controllerName = self::getConfig('controllers/' . $rout[0]);

        $controllerPuth = self::$_baseDir . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR .
            $controllerName . DIRECTORY_SEPARATOR . 'Controller' . DIRECTORY_SEPARATOR . ucfirst($rout[1]) . 'Controller.php';

        if (!file_exists($controllerPuth)) {
            throw new Exception(sprintf('Controller %s not found', $controllerPuth));
        }

        require_once $controllerPuth;

        self::$autoloader->loadClassModule(self::$_baseDir . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR . $controllerName);

        $classController = $controllerName . '_Controller_' . ucfirst($rout[1]) . 'Controller';

        if (!class_exists($classController)) {
            throw new Exception(sprintf('File has been loaded but class %s not found', $classController));
        }

        new $classController;

        return true;
    }

    /**
     * set configuration for applet
     * @param array $config
     *
     * @return array
     */
    static public function setConfig(Array $config)
    {
        return self::$_configuration = $config;
    }

    /**
     * get configuration by key
     *
     * @param null $key
     *
     * @return null
     * @throws Exception
     */
    static public function getConfig($key = null)
    {
        if (is_null($key)) {
            return self::$_configuration;
        }

        $keyArray = explode('/', $key);

        if (!isset(self::$_configuration[$keyArray[0]][$keyArray[1]])) {
            throw new Exception(sprintf('Configuration %s section not found', $key));
        }

        return self::$_configuration[$keyArray[0]][$keyArray[1]];
    }

    /**
     * get block instance
     * @param $blockKey
     *
     * @throws Exception
     *
     * @return $this
     */
    static function getBlock($blockKey)
    {

        $blockKey = explode('/', $blockKey);

        if (count($blockKey) == 1) {
            throw new Exception('please inputt full key example/example');
        }

        if (!Core_Lib_Applet::getConfig('controllers/' . $blockKey[0])) {
            throw new Exception('Module not found in configuration');
        }


        $puthToBlock = Core_Lib_Applet::getBaseDir() . DIRECTORY_SEPARATOR .
            'modules' . DIRECTORY_SEPARATOR .
            Core_Lib_Applet::getConfig('controllers/' . $blockKey[0]) . DIRECTORY_SEPARATOR .
            'Block' . DIRECTORY_SEPARATOR;

        $classBlock = Core_Lib_Applet::getConfig('controllers/' . $blockKey[0]) . '_Block_';

        for ($i = 1; $i < count($blockKey); $i++) {
            $puthToBlock .= ucfirst($blockKey[$i]);
            $classBlock .= ucfirst($blockKey[$i]);
            $puthToBlock .= DIRECTORY_SEPARATOR;
            $classBlock .= '_';
        }

        $puthToBlock = rtrim($puthToBlock, DIRECTORY_SEPARATOR);
        $classBlock = rtrim($classBlock, '_');
        $puthToBlock .= '.php';

        if (!file_exists($puthToBlock)) {
            throw new Exception(sprintf('Block %s not found', $puthToBlock));
        }

        self::loadParentClass($puthToBlock);

        require_once $puthToBlock;


        if (!class_exists($classBlock)) {
            throw new Exception(sprintf('File block load but class %s not found', $classBlock));
        }

        return $classBlock;
    }

    /**
     * load extend file
     *
     * @param $puthToFile
     * @throws Exception
     */
    static function loadParentClass($puthToFile)
    {
        $file = file($puthToFile);
        $classExstandsName = '';
        foreach ($file as $_file) {
            $_stringArray = explode(' ', $_file);
            if ($key = array_search('extends', $_stringArray)) {
                $classExstandsName = $_stringArray[$key + 1];
                break;
            }
        }
        $classExstandsName = trim($classExstandsName);

        $classPuth =
            Core_Lib_Applet::getBaseDir() . DIRECTORY_SEPARATOR .
            'modules' . DIRECTORY_SEPARATOR .
            str_replace('_', DIRECTORY_SEPARATOR, $classExstandsName);

        $classPuth .= '.php';

        if (!file_exists($classPuth)) {
            throw new Exception(sprintf('File %s do not exists', $classPuth));
        }

        require_once $classPuth;

        if (!class_exists($classExstandsName)) {
            throw new Exception(sprintf('File load but class %s not found', $classExstandsName));
        }
    }

}