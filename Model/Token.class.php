<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token{

    public $token = false;

    public function __construct($url){
        
    }

    static function createToken($userId){
        $payload = array(
            "iss" => "daily-tracking.anthony-kalbe.fr",
            "iat" => 1356999524,
            "exp" => 1357000000,
            "userId" => $userId
        );
        $jwt = JWT::encode($payload, new Key($_ENV["SECRET_KEY"]), 'HS256');
        return $jwt;
    }


}