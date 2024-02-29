<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Token{

    public static $token;
    public static $userId = false;
    public static $payload;



    static function createToken($userId){
        $payload = array(
            "iss" => "http://example.org",
            "iat" => 1356999524,
            "exp" => 1357000000,
            "userId" => $userId
        );
        $jwt = JWT::encode($payload, new Key($_ENV["SECRET_KEY"]), 'HS256');
        return $jwt;
    }


}