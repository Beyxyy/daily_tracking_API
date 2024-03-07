<?php

class Response{

    private  $message = '';
    private  $code    = 500;
    private  $status  = 'error';
    private  $data    = [];
    
    public function setData($e){
        $this->message = $e;
        return $this;
    }

    public function setCode($code){
        $this->code = $code;
        return $this;
    }


    public function setResponse(){
         return json_encode($this->data);
    }

    public function sendResponse(){
        if(199 < intval($this->code) and intval($this->code) < 300){
            $this->status = 'success';
        }
        $this->data = array(
            'status'  => $this->status,
            'code'    => $this->code,
            'data' => $this->message,
        );        
         echo $this->setResponse();
        die();
    }
        
}