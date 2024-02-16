<?php

class Token{

    public static $token;
    public static $userId;
    public static $payload;

    public function __construct($bearerToken){
        if(!preg_match('/Bearer\s(\S+)/', $this->token, $matches)) {
            return null;
        }
        $this->verifyToken($matches[1]);
        $this->token = $matches[1];
        $this->payload = $this->decode($this->token);
    
    }


    public function verifyToken(){
        $this->userID;
       return 
    }

    static function createToken($user){
        // utilisation des infos de config pour ajuster la durée de validiter et les infos user
    }


}