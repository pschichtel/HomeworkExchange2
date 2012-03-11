<?php
    interface View
    {
        public function render(array $params = null);
    }
    
    class ViewException extends Exception
    {}
?>
