<?php

    interface View
    {

        public function renderString();

        public function render();
    }

    class ViewException extends Exception
    {
        
    }

?>
