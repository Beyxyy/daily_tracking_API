<?php

class Response{

    private string $message = '';
    private  $code = 500;
    private string $status = 'error';
    private  $data = [];
    
    public function setMessage($e){
        return $this->message = $e;
    }

    public function setCode($code){
        return $this->code = $code;
    }


    public function setData($data){
        return json_encode($data);
    }

    public function sendResponse(){
        if(200<int($this->code)<300){
            $this->status = 'success';
        }
        $data = array(
            'status' => $this->status,
            'message' => $this->message,
            'code' => $this->code,
            'data' => $this->data
        );        
        die();
    }
        
}