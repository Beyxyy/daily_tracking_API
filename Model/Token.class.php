<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

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
    
    }


    public function verifyToken(){
        $decoded = JWT::decode($this->token, new Key($_ENV["SECRET_KEY"], 'HS256'));
    }

    static function createToken($user){
        $payload = array(
            "iss" => "http://example.org",
            "iat" => 1356999524,
            "exp" => 1357000000,
            "userId" => $user
        );
        $jwt = JWT::encode($payload, new Key($_ENV["SECRET_KEY"]), 'HS256');
        return $jwt;
    }


}