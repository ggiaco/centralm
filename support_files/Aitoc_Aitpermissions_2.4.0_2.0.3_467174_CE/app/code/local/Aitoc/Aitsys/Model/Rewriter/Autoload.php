<?php
/**
 * @copyright  Copyright (c) 2009 AITOC, Inc. 
 * @author Andrei
 */
class Aitoc_Aitsys_Model_Rewriter_Autoload
{
    static protected $_instance;
    protected $_rewriteConfig = array();
    protected $_rewriteDir      = '';
    protected $_aitocDirs = array( 'Aitoc' , 'AdjustWare' );
    
    private function __construct()
    {
        $this->_rewriteDir = BP . Aitoc_Aitsys_Model_Rewriter_Abstract::REWRITE_CACHE_DIR;
        $this->_readConfig();
    }
    
    /**
     * @return string
     */
    public function getRewriteDir()
    {
        return $this->_rewriteDir;
    }
    
    static public function instance()
    {
        if (!self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     * @return array()
     */
    public function getConfig()
    {
        return $this->_rewriteConfig;
    }
    
    public function clearConfig()
    {
        $this->_rewriteConfig = array();
    }
    
    public function setupConfig()
    {
        $this->_readConfig();
    }
    
    static public function register( $base = false )
    {
        Mage::register('aitsys_autoload_initialized', true);

        $rewriter = new Aitoc_Aitsys_Model_Rewriter();
        $rewriter->preRegisterAutoloader($base);
        
        // unregistering all, and varien autoloaders to make our performing first
        $autoloaders = spl_autoload_functions();
        if ($autoloaders and is_array($autoloaders) && !empty($autoloaders))
        {
            foreach ($autoloaders as $autoloader)
            {
                spl_autoload_unregister($autoloader);
            }
        }
        if (version_compare(Mage::getVersion(),'1.3.1','>'))
        {
            spl_autoload_unregister(array(Varien_Autoload::instance(), 'autoload'));
        }
        spl_autoload_register(array(self::instance(), 'autoload'), false);
        if (version_compare(Mage::getVersion(),'1.3.1','>'))
        {
            Varien_Autoload::register();
        }
        else
        {
            spl_autoload_register(array(self::instance(), 'performStandardAutoload'));
        }
    }
    
    /**
     * Compatibility with Magento prior 1.3.2
     * 
     *  @param string $class
     */
    public function performStandardAutoload($class)
    {
        return __autoload($class);
    }
    
    public function autoload($class)
    {
        if (in_array($class, array_keys($this->_rewriteConfig)))
        {
            $classFile = $this->_rewriteDir . $this->_rewriteConfig[$class] . '.php';
            try
            {
                return include $classFile;
            }
            catch (Exception $e)
            {
                if (!file_exists($classFile))
                {
                    $rewriter = new Aitoc_Aitsys_Model_Rewriter();
                    $rewriter->prepare();
                    return $this->autoload($class);
                }
                throw $e;
            }
        }
        return false;
    }
    
    protected function _readConfig()
    {
        /**
        * This config was created when creating rewrite files
        */
        $configFile = $this->_rewriteDir . 'config.php';
        if (file_exists($configFile))
        {
            @include($configFile);
        }
        // $rewriteConfig was included from file
        if (isset($rewriteConfig))
        {
            $this->_rewriteConfig = $rewriteConfig;
        }
    }
    
    public function hasClass( $class )
    {
        return isset($this->_rewriteConfig[$class]);
    }
}
