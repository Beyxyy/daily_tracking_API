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

    public function login($data): ?bool
    {
        $this->request = $data;
        // echo '<pre>';
        // var_dump($this->request);
        // echo '</pre>';
        try {
                if(isset($this->request->data["email"]) and isset($this->request->data["password"])){
                    $this->user->setEmail($this->request->data["email"]);
                    $this->user->setPassword($this->request->data["password"]);
                    // $user= $this->user->authenticate();
                    if(true){
                        return $this->token->createToken(2);
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