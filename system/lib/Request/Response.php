<?php
    class Response
    {
        private $content;
        private $status;
        private $headers;
        
        public function __construct()
        {
            $this->content = null;
            $this->status = 200;
            $this->headers = array();
        }
        
        public function getContent()
        {
            return $this->content;
        }
        
        public function setContent($content)
        {
            if ($content instanceof View)
            {
                $content = $content->render();
            }
            $this->content = $content;
            
            return $this;
        }
        
        public function getStatus()
        {
            return $this->status;
        }
        
        public function setStatus($code)
        {
            $this->status = $code;
            
            return $this;
        }
        
        public function setHeader($name, $value)
        {
            $this->headers[strval($name)] = strval($value);
            
            return $this;
        }
        
        public function hasHeader($name)
        {
            return isset($this->headers[strval($name)]);
        }
        
        public function unsetHeader($name)
        {
            unset($this->headers[strval($name)]);
            
            return $this;
        }
        
        public function redirect($target, $code = 302)
        {
            header('Location: ' . $target, $code);
        }
        
        public function send()
        {
            foreach ($this->headers as $name => $value)
            {
                header($name . ': ' . $value);
            }
            echo $this->content;
        }
    }
?>
