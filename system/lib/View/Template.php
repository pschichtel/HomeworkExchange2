<?php

    class Template implements View
    {
        private $file;
        private $parent;
        private $params;

        public function __construct($file, Template $parent = null)
        {
            if (!is_readable($file))
            {
                throw new ViewException('Failed to read template "' . $file . '" !');
            }
            $this->file = $file;

            $this->parent = $parent;
            $this->params = array();
        }

        public function renderString()
        {
            // populate vars

            foreach ($this->params as $name => $value)
            {
                $$name = $value;
            }

            ob_start();
            include $this->file;
            $content = ob_get_clean();

            if ($this->hasParent())
            {
                $content = $this->parent->assign('content', $content)->renderString();
            }

            return $content;
        }

        public function render()
        {
            echo $this->renderString();
        }

        public function assign($name, $value)
        {
            $this->params[$name] = $value;
            if ($this->hasParent())
            {
                $this->parent->assign($name, $value);
            }
            return $this;
        }

        public function multiAssign(array $params)
        {
            foreach ($params as $name => $value)
            {
                $this->assign($name, $value);
            }
            return $this;
        }

        public function setParent(Template $parent)
        {
            $this->parent = $parent;

            return $this;
        }

        public function getParent()
        {
            return $this->parent;
        }

        public function hasParent()
        {
            return ($this->parent !== null);
        }
    }

?>
