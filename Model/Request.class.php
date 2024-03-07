<?php



class Request{

    public $data;
    public $token = null;


    public function __construct($server){
            $raw_data = file_get_contents('php://input');
            $data = json_decode($raw_data, true);
            var_dump(file_get_contents('php://input'));
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                $this->data=null;
            }
            else{
                $this->data = $data;
            }
            
            //HTTP_AUTHORIZATION undefined
            //get the authorization header
            $headers = apache_request_headers();
            $header = isset($headers['Authorization']) ? $headers['Authorization'] : "";
            $this->token = preg_match('/Bearers(S+)/', $header, $matches) ? $matches[1] : null;
            return $this;            
    }

}