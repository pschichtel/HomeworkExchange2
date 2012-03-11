<?php
    class FrontController implements Component
    {
        private $controllerPath;
        private $defaultController;
        private $errorController;
        
        public function __construct()
        {
            $this->defaultController = 'index';
            $this->errorController = 'error';
        }
        
        public function initialize(App $app, array $config)
        {
            $this->controllerPath = SYS_PATH . DIRECTORY_SEPARATOR . $app->getConfig()->get('controllerDir', '.');
            
            if (isset($config['defaultController']))
            {
                $this->defaultController = $config['defaultController'];
            }
            if (isset($config['errorController']))
            {
                $this->errorController = $config['errorController'];
            }
            
            $app->getEventManager()->bind('app_uncaught_exception', array($this, 'errorpage'));
        }
        
        private function loadController($name)
        {
            if ($name === null)
            {
                return null;
            }
            
            $clazz = ucfirst(strtolower($name)) . 'Controller';
            $path = $this->controllerPath . DIRECTORY_SEPARATOR . strtolower($name) . DIRECTORY_SEPARATOR . $clazz . '.php';
            
            if (is_readable($path))
            {
                require_once $path;
                if (class_exists($clazz))
                {
                    $instance = new $clazz();
                    if ($instance instanceof Controller)
                    {
                        return $instance;
                    }
                    else
                    {
                        throw new ComponentException('Controller "' . $name . '" does not implement Controller! ' . $path);
                    }
                }
                else
                {
                    throw new ComponentException('Controller "' . $name . '" does not contain the correct class! ' . $path);
                }
            }
            return null;
        }
        
        public function run()
        {
            $request = new Request();
            $response = new Response();
            
            App::get()->getEventManager()->trigger('request_preprocess', array($request));
            
            $controller = $this->loadController($request->getController());
            if ($controller === null)
            {
                $controller = $this->loadController($this->defaultController);
                if ($controller === null)
                {
                    throw new ComponentException('Default controller not found!');
                }
            }
            
            $action = $request->getAction();
            if ($action !== null && is_callable(array($controller, $action . 'Action')))
            {
                $controller->{$action . 'Action'}($request, $response);
            }
            else
            {
                $controller->indexAction($request, $response);
            }
            
            App::get()->getEventManager()->trigger('request_postprocess', array($request, $response));
            
            $response->send();
        }
        
        public function errorpage($app, $exception)
        {
            
        }
    }
?>
