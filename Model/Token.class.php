<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token{

    public $token = false;

    public function __construct($url){
        
    }

    static function createToken($user){
        if($user instanceof User){
             $payload = array(
            "iss" => "daily-tracking.anthony-kalbe.fr",
            "iat" => time(),
            "exp" => time() + 360000,
            "userId" => $user->getId(),
            "userName" => $user->getName(),
            "userCreatedAt" => $user->getCreatedAt(),
        );
        $jwt = JWT::encode($payload, $_ENV["SECRET_KEY"], 'HS256');
        return $jwt;
        }
        else{
            return false;
        }

    }


}