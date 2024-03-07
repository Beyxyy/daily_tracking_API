<?php

class CtrlConnexion
{
    private $user;
    private $response;
    private $token;
    private $request;

    public function __construct($url)
    {
        $this->user = new User();
        $this->response = new Response();
        $this->token = new Token($url);
    }

    public function login($data)
    {
        $this->request = $data;
        try {
                if(isset($this->request->data["email"]) and isset($this->request->data["password"])){
                    $this->user->setEmail($this->request->data["email"]);
                    $this->user->setPassword($this->request->data["password"]);
                    $user= $this->user->authenticate();
                    $this->user = new User($user[0]["user_id"]);
                    if($user){
                        return $this->token->createToken($this->user);
                    }
                    else{
                        return false;
                    }
                }
                else{
                   return false;
                }
        } catch (Exception $exception) {
            //die quietly
            return false;
        }
    }


    public function verify($token){
        
    }
}