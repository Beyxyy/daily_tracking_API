<?php

class CtrlConnexion
{
    private $user;
    private $response;
    private $token;
    private $request;

    public function __construct()
    {
        $this->user = new User();
        $this->response = new Response();
        $this->token = new Token();
        $this->request = new Request();
    }

    public function login($data): ?bool
    {
        $this->request = $data;
        try {
                if(isset($this->request->body->email) and isset($this->request->body->password)){
                    $this->user->email = $this->request->body->email;
                    $this->user->password = $this->request->body->password;
                    $user= $this->user->login();
                    if($user){
                        return $this->token->createToken($user->user_id);
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