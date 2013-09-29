<?php

    class ClassLoader
    {
        private static $instance = null;
        private $path;
        
        public static $classmap = array(
            'Controller'            => 'Controller.Controller',
            'CommonController'      => 'Controller.CommonController',
            'App'                   => 'App',
            'Component'             => 'Component',
            'ComponentException'    => 'Component',
            'EventManager'          => 'EventManager',
            'Configuration'         => 'Util.Config.Configuration',
            'PhpConfiguration'      => 'Util.Config.PhpConfiguration',
            'DbConfiguration'       => 'Util.Config.DbConfiguration',
            'Request'               => 'Request.Request',
            'Response'              => 'Request.Response',
            'Session'               => 'Request.Session',
            'View'                  => 'View.View',
            'Template'              => 'View.Template'
        );
        
        private function __construct()
        {
            $this->path = dirname(__FILE__) . DIRECTORY_SEPARATOR;
        }
        
        public static function register()
        {
            if (self::$instance === null)
            {
                self::$instance = new self();
                foreach (self::$classmap as &$entry)
                {
                    $entry = str_replace('.', DIRECTORY_SEPARATOR, $entry) . '.php';
                }
                    
                spl_autoload_register(array(self::$instance, 'load'));
            }
        }
        
        public function load($classname)
        {
            if (isset(self::$classmap[$classname]))
            {
                $path = $this->path . self::$classmap[$classname];
                if (file_exists($path))
                {
                    require_once $path;
                }
            }
        }
    }

?>
