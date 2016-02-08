<?php
/**
 * 
 * @autor naumov roman <family_89@mail.ru>
 *
 * @codepool core
 * @package lib
 *
 * this auto loader
 * 
 * Мне очень стыдно за этот файл, так как есть функция в php __autoload();
 * 
 * Class Core_Lib_Autoloader
 */
class Core_Lib_Autoloader
{
    /**
     * constructor
     *
     * @throws Exception
     */
    public function __construct()
    {
        //init core lib
        $this->_initCoreLib();
        $configurationApplet = $this->_getConfiguration();
        Core_Lib_Applet::setConfig($configurationApplet);
    }

    /**
     * configuration applet
     * @return array
     * @throws Exception
     */
    protected function _getConfiguration()
    {
        $fileConfig = glob(Core_Lib_Applet::getBaseDir() . DIRECTORY_SEPARATOR . 'etc' . DIRECTORY_SEPARATOR . '*.php');

        $config = array();
        $controllers = array();
        $modules = array();
        // load config files
        foreach ($fileConfig as $_puth) {
            require_once $_puth;
        }

        $configurationArray = array(
            'config' => $config,
            'controllers' => $controllers,
            'modules' => $modules,
        );

        return $configurationArray;
    }

    /**
     * load class for modules
     *
     */
    public function loadClassModule($puthToModules)
    {
        $fileBlock = glob($puthToModules . DIRECTORY_SEPARATOR . 'Block' . DIRECTORY_SEPARATOR . '*.php');
        foreach ($fileBlock as $_block) {
            require_once $_block;
        }
        return true;
    }

    /**
     * init core librari
     * @throws Exception
     */
    protected function _initCoreLib()
    {
        $fileLib = glob(Core_Lib_Applet::getBaseDir() . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'lib' . DIRECTORY_SEPARATOR . '*.php');
        foreach ($fileLib as $_requerPuth) {
            if (!file_exists($_requerPuth)) {
                throw new Exception(sprintf('file %s not found', $_requerPuth));
                continue;
            }
            require_once $_requerPuth;
        }
    }
}
