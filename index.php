<?php
require_once './Config/Config.class.php';
require_once './Controler/CtrlRouter.class.php';
require_once './Model/Request.class.php';
require_once './Model/Response.class.php'; 
require_once './Models/Routes.php';
require_once './Model/Token.class.php';
require_once './Model/Database.class.php';
require './vendor/autoload.php';
require_once './Model/Request.class.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$token = new Token(Request::$auth);
if($token->userId){
    $router = new CtrlRouter($_SERVER);
}
else{
    $response = new Response();
    $response->setMessage('Token is not valid, you must be authenticate to use this endpoint, login and try again')
                ->setCode(401)
                ->sendResponse();
}



