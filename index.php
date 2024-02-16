<?php
require_once './Config/Config.class.php';
require_once './Controler/CtrlRouter.class.php';
require_once './Model/Request.class.php';
require_once './Model/Response.class.php'; 
require_once './Models/Routes.php';
require_once './Model/Token.class.php';
require_once './Model/Database.class.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

Request::initContent();
$router = new CtrlRouter($_SERVER);
