<?php

class Token{

    public $token;


    public function __construct($bearerToken){
        if(!preg_match('/Bearer\s(\S+)/', $this->token, $matches)) {
            return null;
        }
        return $matches[1];
    }


    public function verifyToken(){
       //vérifier si le token est valide et pas expiré
    }

    static function createToken($user){
        // utilisation des infos de config pour ajuster la durée de validiter et les infos user
    }
}