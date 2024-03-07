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
                 $this-> response ->setMessage('Welcome to the Daily Tracking API')
                                  ->setCode(202)
                                 ->sendResponse();
            });

            $this->router->map('GET','/training/[i:id]/', function($id) {
                if($this->CtrlConnexion->isLogin)
                  $this-> training ->getTraining($id);
            });

            $this->router->map('GET','/login', function($request, $response, $args) {
                $login["token"] = $this -> CtrlConnexion -> login($request);
                 $response->setMessage(json_encode($login))
                         ->setCode(200)
                         ->sendResponse();
            });

            $match = $this->router->match();  
            // echo '<pre>';  
            // var_dump($match);       
            // echo '<pre>';  
            if ($match !=false && is_callable($match['target'])) {
                // La correspondance est réussie et la cible est une fonction callable
                call_user_func_array($match['target'], $match['params']);
            } else {
                // Gérer le cas où aucune correspondance n'est trouvée
                echo "Aucune correspondance trouvée.";
            }

         } catch (Exception $exception){
            $this-> response -> setMessage($exception->getMessage())
                             -> setCode($exception->getCode())
                             -> sendResponse();
         }
         return true;
     }
}