<?php



class Request{

    static $data = "";
    static $token = null;


    public function __construct(){
            $raw_data = file_get_contents('php://input');
            $data = json_decode($raw_data, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                self::$data="";
            }
            else{
                self::$data = $data;
            }

            self::$token = $_SERVER['AUTHORIZATION'].split("Bearer ")[1];
            
    }

}