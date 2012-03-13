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
            $this->templateProvider = App::get()->cTemplateProvider;
        }

        protected function render($template, array $params = array())
        {
            $template = $this->templateProvider->getTemplate($this->name, $template);
            if ($template !== null)
            {
                $template->multiAssign($params)->render();
            }
        }
    }

?>
