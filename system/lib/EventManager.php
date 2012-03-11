<?php
    class EventManager
    {
        private $eventhandler;
        
        public function __construct()
        {
            $this->eventhandler = array();
        }
        
        public function bind($event, $handler)
        {
            if (is_string($event) && is_callable($handler))
            {
                if (isset($this->eventhandler[$event]))
                {
                    $this->eventhandler[$event][] = $handler;
                }
                else
                {
                    $this->eventhandler[$event] = array($handler);
                }
            }
        }
        
        public function trigger($event, array $args = array())
        {
            if (isset($this->eventhandler[$event]))
            {
                foreach ($this->eventhandler as $handler)
                {
                    call_user_func_array($handler, $args);
                }
            }
        }
    }
?>
