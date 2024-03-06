<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
require_once './Config/Config.class.php';
require_once './Controler/CtrlRouter.class.php';
require_once './Model/Request.class.php';
require_once './Model/Response.class.php'; 
require_once './Model/Token.class.php';
require_once './Model/Training.class.php';
require_once './Model/Database.class.php';
require_once './Controler/CtrlConnexion.class.php';
require_once './Model/User.class.php';
require_once './Model/Exercice.class.php';
require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


$router = new CtrlRouter($_SERVER);




