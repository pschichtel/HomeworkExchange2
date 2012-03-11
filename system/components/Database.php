<?php
    class Database extends PDO implements Component
    {
        private $dsn;
        
        public function __construct()
        {}
        
        public function initialize(App $app, array $config)
        {
            if (isset($config['dsn']))
            {
                $this->dsn = $config['dsn'];
            }
            else
            {
                throw new ComponentException('Failed to initalize the database component, no DSN given!');
            }
            parent::__construct($this->dsn, $config['user'], $config['pass'], $config['options']);
            $this->setAttribute(self::ATTR_ERRMODE, self::ERRMODE_EXCEPTION);
            $this->query('SET CHARACTER SET \'' . $config['charset'] . '\'');
        }
    }
?>
