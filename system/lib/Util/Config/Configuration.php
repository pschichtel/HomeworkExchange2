<?php
    class Configuration implements ArrayAccess, IteratorAggregate
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
        
        public function getIterator()
        {
            return new ArrayIterator($this->config);
        }
        
        public function offsetExists($offset)
        {
            return $this->has($offset);
        }
        public function offsetGet($offset)
        {
            return $this->get($offset);
        }
        
        public function offsetSet($offset, $value)
        {}
        public function offsetUnset($offset)
        {}
    }
    
    class ConfigurationException extends Exception
    {}
?>
