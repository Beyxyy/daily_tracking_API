<?php



class Request{

    static $data = "";
    static $token = null;


    public function __construct($server){
            $raw_data = file_get_contents('php://input');
            $data = json_decode($raw_data, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                self::$data="";
            }
            else{
                self::$data = $data;
            }


            //HTTP_AUTHORIZATION undefined
            //get the authorization header
            $headers = apache_request_headers();
            $header = $headers['Authorization'];
            self::$token = preg_match('/Bearers(S+)/', $header, $matches) ? $matches[1] : null;
        
            
    }

}