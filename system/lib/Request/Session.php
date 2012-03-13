<?php
    class Session
    {
        private static $instance = null;
        private static $namespace = 'namespace';
        
        private $started;

        /**
         * constructs and prepares the session
         */
        private function __construct()
        {
            $this->started = false;
        }

        /**
         * Returns the singleton instance of the session
         *
         * @return Session the session
         */
        public static function getInstance()
        {
            if (self::$instance === null)
            {
                self::$instance = new self();
            }
            return self::$instance;
        }

        /**
         * Sets the namespace to use
         *
         * @param string $namespace the namespace
         */
        public static function setNamespace($namespace)
        {
            self::$namespace = strval($namespace);
        }

        /**
         * Returns the current namespace
         *
         * @return string the namespace
         */
        public static function getNamespace()
        {
            return self::$namespace;
        }

        /**
         * Sets the name to use
         *
         * @param string $name
         * @return Session fluent interface
         */
        public function setName($name)
        {
            session_name($name);
            return $this;
        }

        /**
         * Returns the current name of the session
         *
         * @return string the name
         */
        public function getName()
        {
            return session_name();
        }

        /**
         * Sets the session ID to use
         *
         * @param string $id
         * @return Session fluent interface
         */
        public function setId($id)
        {
            session_id($id);
            return $this;
        }

        /**
         * Returns the current session ID
         *
         * @return string the current session ID
         */
        public function getId()
        {
            return session_id();
        }

        /**
         * Starts the session management
         *
         * @return Session fluent interface
         */
        public function start()
        {
            if (!$this->started)
            {
                session_start();
                if (!isset($_SESSION[self::$namespace]) || !is_array(self::$namespace))
                {
                    $_SESSION[self::$namespace] = array();
                }
                $this->started = true;
            }
            return $this;
        }

        /**
         * This ends the session and saves its contents
         */
        public function end()
        {
            if ($this->started)
            {
                session_write_close();
                $_SESSION = null;
            }
        }

        /**
         * This destroys the session
         */
        public function destroy()
        {
            unset($_SESSION[self::$namespace]);
            $this->end();
        }

        /**
         * Checks whether the session contains a value
         *
         * @param string $name the name
         * @return boolean true if it exists
         */
        public function has($name)
        {
            if ($this->started)
            {
                return isset($_SESSION[self::$namespace][$name]);
            }
            return false;
        }

        /**
         * Returns a value from the current session or the given default value if the actual value does not exist
         *
         * @param string $name the name
         * @param mixed $def the default value
         * @return mixed the requested value or the given default value
         */
        public function get($name, $def = null)
        {
            $this->start();
            if (isset($_SESSION[self::$namespace][$name]))
            {
                return $_SESSION[self::$namespace][$name];
            }
            return $def;
        }

        /**
         * Sets a value to in current session
         *
         * @param string $name the name
         * @param mixed $value the value
         * @return Session fluent interface
         */
        public function set($name, $value)
        {
            $this->start();
            $_SESSION[self::$namespace][$name] = $value;
            
            return $this;
        }

        /**
         * Regenerates a new session ID and drops the old
         */
        public function regenerateId()
        {
            session_regenerate_id(true);
        }
    }
?>
