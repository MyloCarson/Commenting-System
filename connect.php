<?php
header('Access-Control-Allow-Origin: *');
session_start();
require_once('CMySQL.php'); // including service class to work with database
require_once('CServices.php');
// require_once('link.php');
    extract($_REQUEST);
$link = new CServices();
if(!empty($_POST)){
        switch ($_POST['request_code']) {
            case 1:
            $password = hash("sha256", $_POST['password']);
                $data = array('email'=>$_POST['email'],
                    'password'=>$password);
                $response =$link->login($data);
                break;
            
            case 2:
            $password = hash("sha256", $_POST['password']);

            $data = array("email"=>$_POST['email'],
                'username'=>$_POST['username'],
                'password'=>$password
                );
                $response = $link->signUp($data);
                break;

            case 3:
                $response = "Welcome";// $link->forgotPassword($_POST['password']);
                break;

            case 4:
            $data = array('userID'=>$_POST['userID'],
                'topic'=>$_POST['topic'],
                'thread'=>$_POST['thread'],
                'comment'=>$_POST['comment']
                );
                $response = $link->insert_comment($data);
                break;
            case 5:
            $data =array('theNewsId'=>$_POST['theNewsId']);
                $response = $link->getComment($data);
                break;
        } 
    }

echo $response;
?>