<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
header("Access-Control-Allow-Origin: *");

// Autorise les méthodes HTTP spécifiques
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");

// Autorise certains en-têtes HTTP
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Expose certains en-têtes HTTP
header("Access-Control-Expose-Headers: Authorization");

// Indique si les en-têtes peuvent être inclus dans la réponse
header("Access-Control-Allow-Credentials: true");

// Définis le type de contenu pour les réponses pré-vérifiées
header("Content-Type: application/json");

// Vérifie la méthode de la requête
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // C'est une pré-requête CORS, renvoie une réponse vide avec les entêtes CORS
    http_response_code(200);
    exit();
}

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




