<?php
    class IndexController extends CommonController
    {
        public function __construct()
        {
            parent::__construct('index');
        }
        
        public function indexAction(Request $request, Response $response)
        {
            
            $db = App::get()->getComponent('database');
            
            $statement = $db->prepare('SELECT * FROM `users`');
            $statement->execute();
            
            var_dump($statement->fetchAll(PDO::FETCH_ASSOC));
            
            
            $response->setContent($this->render('index', array(
                'request' => $request
            )));
        }
        
        public function blubAction(Request $request, Response $response)
        {
            $a = mt_rand();
            $b = mt_rand();
            $response->setContent($this->render('blub', array(
                'random' => mt_rand(min($a, $b), max($a, $b))
            )));
        }
    }
?>
