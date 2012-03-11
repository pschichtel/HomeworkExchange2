<?php
    class Template implements View
    {
        private $file;
        private $parent;
        
        public function __construct($file, Template $parent = null)
        {
            if (!is_readable($file))
            {
                throw new ViewException('Failed to read template "' . $file . '" !');
            }
            $this->file = $file;
            
            $this->parent = $parent;
        }
        
        public function render(array $params = array())
        {
            foreach ($params as $name => $param)
            {
                if ($name != 'this')
                {
                    ${$name} = $param;
                }
            }
            unset($params);
            
            ob_start();
            include $this->file;
            $content = ob_get_clean();
            
            if ($this->parent !== null)
            {
                $content = $this->parent->render(array('content' => $content));
            }
            
            return $content;
        }
        
        public function setParent(Template $parent)
        {
            $this->parent = $parent;
        }
        
        public function getParent()
        {
            return $this->parent;
        }
    }
?>
