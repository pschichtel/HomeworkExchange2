<?php
    class Configuration implements IteratorAggregate
    {
        private $config;
        
        public function __construct(array $config)
        {
            $this->config = $config;
        }
        
        public function has($name)
        {
            return isset($this->config[$name]);
        }
        
        public function get($name, $def = null)
        {
            if ($this->has($name))
            {
                return $this->config[$name];
            }
            return $def;
        }

        protected function set($key, $value)
        {
            $this->config[strval($key)] = $value;
        }

        protected function remove($key)
        {
            if ($this->has($key))
            {
                unset($this->config[$key]);
            }
        }

        public function getIterator()
        {
            return new ArrayIterator($this->config);
        }
    }
    
    class ConfigurationException extends Exception
    {}
?>
