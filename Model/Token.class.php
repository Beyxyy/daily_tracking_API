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

    public function verifyToken($token, $id=null){
        if($token == null){
            return false;
        }
        if($id == null){
            $decoded = JWT::decode($token, new Key($_ENV["SECRET_KEY"], 'HS256'));
            return $decoded;
        }
        else{
            $decoded = JWT::decode($token, new Key($_ENV["SECRET_KEY"], 'HS256'));
            if($decoded->userId == $id){
                return $decoded;
            }
            else{
                return false;
            }
        }
        $decoded = JWT::decode($token, new Key($_ENV["SECRET_KEY"], 'HS256'));
        return $decoded;
    }


}