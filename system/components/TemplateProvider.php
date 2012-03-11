<?php
    defined('DS') or define('DS', DIRECTORY_SEPARATOR);

    class TemplateProvider implements Component
    {
        private $themePath;
        private $controllerBasePath;
        private $controllersDir;
        private $theme;
        private $extention;
        
        public function initialize(App $app, array $config)
        {
            $appConfig = $app->getConfig();
            
            $this->themePath = APP_PATH . DS . $appConfig->get('themeDir', 'themes') . DS;
            $this->controllersDir = $appConfig->get('controllerDir');
            $this->controllerBasePath = SYS_PATH . DS . $this->controllersDir . DS;
            
            $this->theme = (isset($config['theme']) ? $config['theme'] : 'default');
            $this->extention = (isset($config['extention']) ? $config['extention'] : '.php');
        }
        
        public function getLayout()
        {
            $path = $this->themePath . $this->theme . DS . 'views' . DS . 'layout' . $this->extention;
            if (is_readable($path))
            {
                return new Template($path);
            }
            return null;
        }
        
        public function getTemplate($controller, $templateFile)
        {
            $controller = strtolower($controller);
            $templateFile = str_replace('/', DS, $templateFile) . $this->extention;
            $template = null;
            
            $path = $this->themePath . $this->theme . DS . 'views' . DS . $this->controllersDir . DS . $controller . DS . $templateFile;
            if (is_readable($path))
            {
                $template = new Template($path);
            }
            else
            {
                $path = $this->controllerBasePath . $controller . DS . 'views' . DS . $templateFile;
                if (is_readable($path))
                {
                    $template = new Template($path);
                }
            }
            
            if ($template !== null)
            {
                $layout = $this->getLayout();
                if ($layout !== null)
                {
                    $template->setParent($layout);
                }
            }
            
            return $template;
        }
        
        public function setTheme($name)
        {
            $this->theme = $name;
            
            return $this;
        }
        
        public function getTheme()
        {
            return $this->theme;
        }
    }
?>
