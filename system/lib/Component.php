<?php
    interface Component
    {
        public function initialize(App $app, array $config);
    }
    
    class ComponentException extends Exception
    {}
?>
