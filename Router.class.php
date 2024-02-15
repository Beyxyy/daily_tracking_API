<?php
require_once './Models/Routes.php';
require_once 'Token.class.php';

class Router{

    private string $url;
    private string $method;
    private ?Token $token;
     public function __construct($url){

       $this->url = $url['REQUEST_URI'];
       $this->method = $url['REQUEST_METHOD'];
       $this->token = $this->ExtractToken($url);

        return $this->route();
     }


     private function ExtractToken($url) {
         $authorizationHeader = $url['HTTP_AUTHORIZATION'] ?? '';
        preg_match('/Bearer\s(\S+)/', $authorizationHeader, $matches);
        return $matches[1] ? new Token($matches[1])  : false;
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
             $route = Route::getRoute($this->url, $this->method);

             if (!$route) {
                 throw new Exception('No existing route');

             }

             $class = $route['class_name'];
             $method = $route['method_name'];
             $auth = $route['auth'];

             if (class_exists($class) && method_exists($class, $method)) {
                 if($auth!=NULL && !$this->token){
                     throw new Exception("No token send, you must be authenticate to use this endpoint, login and try again");
                 }

                 if($auth!=NULL && $this->token){
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