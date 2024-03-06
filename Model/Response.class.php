<?php

class Response{

    private  $message = '';
    private  $code    = 500;
    private  $status  = 'error';
    private  $data    = [];
    
    public function setMessage($e){
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
        if(200 <intval($this->code) and intval($this->code) < 300){
            $this->status = 'success';
        }
        $this->data = array(
            'status'  => $this->status,
            'code'    => $this->code,
            'message' => $this->message,
            'data'    => $this->data
        );        
         echo $this->setResponse();
        die();
    }
        
}