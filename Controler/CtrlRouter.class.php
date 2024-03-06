<?php


class CtrlRouter{

    private $url;
    private $method;
    private $token;
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


     private function route(): ?bool
     {
         try {
            $this->router->map('GET', '/', function() {
                
            });

            $this->router->map('GET','/training/[i:id]/', function($id) {
                $this-> training ->getTraining($id);
            });

            $this->router->map('GET','/login', function($request, $response, $args) {
                $login["token"] = $this -> CtrlConnexion -> login($request);
                $response->setMessage(json_encode($login))
                         ->setCode(200)
                         ->sendResponse();
            });

            $match = $this->router->match();  

         } catch (Exception $exception){
            $this-> response -> setMessage($exception->getMessage())
                             -> setCode($exception->getCode())
                             -> sendResponse();
         }
         return true;
     }
}