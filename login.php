<?php
    error_reporting(-1);
    
    $config = require_once 'config/mysql.php';
    
    @session_start();
    
    $db = new PDO($config['driver'] . ':host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['dbname'], $config['user'], $config['pass']);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
    if(isset($_GET['username']) && isset($_GET['password']))
    {
        $statement = $db->prepare("SELECT * FROM `users` WHERE `username`=?");
        $statement->execute(array($_GET['username']));
        $userdata = $statement->fetch(PDO::FETCH_ASSOC);
        if($userdata['password'] == md5($_GET['password']) && $_GET['password'] != "")
        {
            echo "success";
            $_SESSION['loggedin'] = true;
            $_SESSION['permissions'] = intval($userdata['permissionState']);
            $_SESSION['username'] = $_GET['username'];
            $_SESSION['uid'] = $userdata['id'];
            //header('Location: index.php?page=pages/home.php');
        }
        else
        {
            echo "Login failed";
        }
    }
    
    //echo var_dump($userdata);
    
    session_start();
    
    
?>
