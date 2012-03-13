<?php

    class IndexController extends CommonController
    {

        public function __construct()
        {
            parent::__construct('index');
        }

        public function indexAction(Request $request, Response $response)
        {
            $db = App::get()->getComponent('Database');

            $statement = $db->prepare('SELECT * FROM `users`');
            $statement->execute();

            var_dump($statement->fetchAll(PDO::FETCH_ASSOC));


            $this->render('index', array(
                'request' => $request
            ));
        }
    }

?>
