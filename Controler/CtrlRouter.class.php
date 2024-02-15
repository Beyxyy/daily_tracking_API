<?php
require_once './Models/Routes.php';
require_once 'Token.class.php';

class CtrlRouter{

    private string $url;
    private string $method;
    private ?Token $token;
    
     public function __construct($url){

       $this->url = $url['REQUEST_URI'];
       $this->method = $url['REQUEST_METHOD'];
       $this->token = new Token($url);

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

    private function analyseUrl($url){
        
    }

     private function route(): ?bool
     {
         try {
            $routes = Route::getRoutes();

            //test of all the routes using regex
            foreach ($routes as $route){
                if(preg_match($route['route_url'], $this->url)){
                    $this->url = $route['route_url'];
                }

             $route = Route::getRoute($this->url);

            


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
             return self::handleError($exception->getMessage());
         }
         return true;
     }
}