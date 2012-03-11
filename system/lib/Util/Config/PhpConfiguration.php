<?php
    class PhpConfiguration extends Configuration
    {
        public function __construct($file)
        {
            if (!is_readable($file))
            {
                throw new ConfigurationException('File does not exist or is not readable! ' . $file);
            }
            $config = include $file;
            if (!is_array($config))
            {
                throw new ConfigurationException('The given configuration is invalid! ' . $file);
            }
            parent::__construct($config);
        }
    }
?>
