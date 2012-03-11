<?php

    class Request
    {
        private $argc;
        private $argv;
        
        public function __construct()
        {
            $this->argc = 0;
            $this->argv = array();
            if (isset($_SERVER['PATH_INFO']))
            {
                $path = trim($_SERVER['PATH_INFO'], '/');
                if (strlen($path))
                {
                    $this->argv = explode('/', $path);
                    $this->argc = count($this->argv);
                }
            }
        }
        
        public function getController()
        {
            if ($this->argc > 0)
            {
                return $this->argv[0];
            }
            return null;
        }
        
        public function getAction()
        {
            if ($this->argc > 1)
            {
                return $this->argv[1];
            }
            return null;
        }
        
        public function getArgc()
        {
            return $this->argc;
        }
        
        public function getArgs()
        {
            return $this->argv;
        }
        
        public function getArg($index, $def = null)
        {
            if (isset($this->argv[$index]))
            {
                return $this->argv[$index];
            }
            return $def;
        }
        
        public function getGET($name, $def = '')
        {
            if (isset($_GET[$name]))
            {
                return $_GET[$name];
            }
            return $def;
        }
        
        public function getPOST($name, $def = '')
        {
            if (isset($_POST[$name]))
            {
                return $_POST[$name];
            }
            return $def;
        }
        
        public function getCOOKIE($name, $def = '')
        {
            if (isset($_COOKIE[$name]))
            {
                return $_COOKIE[$name];
            }
            return $def;
        }
    }

?>
