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
    public $request;
    public $body;  

    
     public function __construct($url){

       $this->url = $url['REQUEST_URI'];
       $this->method = $url['REQUEST_METHOD'];
       $this->token = new Token($url);
       $this->response = new Response();
       $this->request = new Request($_SERVER);
       $this->router = new AltoRouter();
       $this->training = new Training();
       $this->CtrlConnexion = new CtrlConnexion($url);
       $this->user = new User();
       $this->exercice = new Exercice();
       return $this->route();
        
     }


     private function route()
     {
        try {
            $this->router->map('GET', '/', function() {
                 $this-> response ->setData('Welcome to the Daily Tracking API')
                                  ->setCode(202)
                                 ->sendResponse();
            });

            $this->router->map('GET','/training/[i:id]/', function($id) {
                if($this->CtrlConnexion->isLogin)
                  $this-> training ->getTraining($id);
            });

            $this->router->map('GET','/login', function() {
                $login["token"] = $this -> CtrlConnexion -> login($this->request);
                if($login["token"] != false){
                    $this->response->setData(json_encode($login))
                                ->setCode(200)
                                ->sendResponse();
                }
                else{
                    $this->response->setCode(500)
                                   ->sendResponse();
                }
                 
            });

            $match = $this->router->match();  
            if ($match !=false && is_callable($match['target'])) {
                call_user_func_array($match['target'], $match['params']);
            } else {
                echo "Aucune correspondance trouvée.";
            }

         } catch (Exception $exception){
            $this-> response -> setData($exception->getMessage())
                             -> setCode($exception->getCode())
                             -> sendResponse();
         }
         return true;
     }
}