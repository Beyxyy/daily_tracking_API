<?php
require './Config/Config.class.php';
require './Controler/CtrlRouter.class.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router = new CtrlRouter($_SERVER);