<?php


class CtrlRouter{

    private Request $request;
    private ?Token $token;
    private Response $response
    
     public function __construct($url){
       $this->request = new request($url);
       $this->reponse = new Response;
       $this->token = new Token($this->request->auth)->verifyToken();

        return $this->route();
     }

     private function analyseUrl($url){

     }

    private function match($url){
        $url = trim($url, '/');
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $url);
        $regex = "#^$path$#i";
        if(!preg_match($regex, $url, $matches)){
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;  // On sauvegarde les paramètres dans l'instance pour plus tard
        return true;
    }


     private function route(): ?bool
     {
         try {
            $routes = Route::getRoutes();

            //test of all the routes using regex

               if($this->match($this->url)){
                   $route = Route::getRoute($this->url);
               }


                if (!$route) {
                     throw new Exception('No existing route');

                }

                $class = $route['class_name'];
                $method = $route['method_name'];
                $auth = $route['auth'];

                 if (class_exists($class) && method_exists($class, $method)) {
                     if($auth!=NULL && !$this->token->isToken()){
                         throw new Exception("No token send, you must be authenticate to use this endpoint, login and try again");
                     }

                     if($auth!=NULL && $this->token->isToken()){
                         if($this->token->verifyRight($auth)){
                             throw new Exception("Missing right");
                         }
                     }

                     if($method != $this->method){
                         throw new Exception("Wrong method");
                     }

                     $instance = new $class();
                     $instance->$method();
                 }

            } catch (Exception $exception){
             $this-> response -> setMessage($exception->getMessage())
                              -> setCode($exception->getCode());
                              -> sendResponse();
                              
         }
         return true;
     }
}