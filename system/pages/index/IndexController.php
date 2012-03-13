<?php
    class IndexController extends CommonController
    {
        public function __construct()
        {
            parent::__construct('index');
        }
        
        public function indexAction(Request $request, Response $response)
        {
            /*
             * Action example
             * 
            $db = App::get()->getComponent('database');
            
            $statement = $db->prepare('SELECT * FROM `users`');
            $statement->execute();
            
            var_dump($statement->fetchAll(PDO::FETCH_ASSOC));
            
            
            $response->setContent($this->render('index', array(
                'request' => $request
            )));
            */
             
        }
    }
?>
