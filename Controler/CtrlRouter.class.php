<?php
require_once './Models/Routes.php';
require_once 'Token.class.php';

class CtrlRouter{

    private string $url;
    private string $method;
    private ?Token $token;
    private $router;
    private $response;
    private $training;
    private $user;
    private $exercice;

    
     public function __construct($url){

       $this->url = $url['REQUEST_URI'];
       $this->method = $url['REQUEST_METHOD'];
       $this->token = new Token($url);
       $this->response = new Response();
       $this->router = new AltoRouter();


       $this->training = new Training();
       $this->CtrlConnexion = new CtrlConnexion();
       $this->user = new User();
       $this->exercice = new Exercice();

       return $this->route();
     }


     static function handleError($e){
         $err_data = array(
             'status' => 'error',
             'message' => $e
         );

         $json_err_response = json_encode($err_data);
         header('Content-Type: application/json');
        echo $e;
        die();
    }

     private function route(): ?bool
     {
         try {
            $this->router->map('GET', '/', function() {
                $this-> response ->setMessage('Welcome to the Daily Tracking API')
                                 ->setCode(200)
                                 ->sendResponse();
            });

            $this->router->map('GET','/training/[i:id]/', function($id) {
                $this-> training ->getTraining($id);
            });

            $this->router->map('GET|POST','/login', function($request, $response, $args) {
                $login["token"] = $this -> CtrlConnexion -> login($request);
                $response->setMessage(json_encode($login))
                         ->setCode(200)
                         ->sendResponse();
            });

            

         } catch (Exception $exception){
            $this-> response -> setMessage($exception->getMessage())
                             -> setCode($exception->getCode())
                             -> sendResponse();
         }
         return true;
     }
}