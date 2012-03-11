<?php
    abstract class CommonController implements Controller
    {
        protected $name;
        protected $session;
        protected $templateProvider;
        
        public function __construct($name)
        {
            $this->name = $name;
            $this->session = Session::getInstance();
            $this->templateProvider = App::get()->getComponent('templateprovider');
        }
        
        protected function render($template, array $params = array())
        {
            $template = $this->templateProvider->getTemplate($this->name, $template);
            if ($template !== null)
            {
                return $template->render($params);
            }
            return null;
        }
    }
?>
