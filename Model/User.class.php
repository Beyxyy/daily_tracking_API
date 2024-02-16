<?php

class User extends Database{

    private ?int $id = false;
    private string|null $name = null;
    private string|null $email = null;
    private string|null $password = null;
    private string|null $createdAt = null;
    private string|null $status = null;
    // private string|null 


    public function __construct(?int $id = false){
        $this->id = $id;
        if(!$this->id){
            $this->name = $this->getName();
            $this->name = $this->getEmail();
            $this->name = $this->getPassword();
            $this->name = $this->getStatus();
            $this->createdAt = new DatetimeImmutable();
        }

    }

    public function getName(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT user_name from user WHERE user_id = ?;", $this->id);
    }

    public function getEmail(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT user_email from user WHERE user_id = ?;", $this->id);
    }

    public function getPassword(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT user_password from user WHERE user_id = ?;", $this->id);
    }

    public function getStatus(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT user_status from user WHERE user_id = ?;", $this->id);
    }

    public function authenticateUser($email, $password){
        if(empty($email) and empty($password)){
            return;
        }
        return $this->execReqPrep("SELECT user_id FROM user WHERE user_email = ? AND user_password = ?", [$email, $password]); 
    }

    //récupération d'un seul user à partir de son id
    public function getUser() : ?int{
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("Select * from user WHERE user_id = ?;", $this->id);

    }

    //récupération de tous les users
    public function getUsers() : ?array{
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("Select * from user");
    }


    //mise à jour d'un suer
    public function updateUser(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep('UPDATE user SET user_name=?, user_email=?, user_password=?, user_status=?  WHERE user_id = ', [$this->name, $this->email, $this->pwd, $this->status, $this->id]);
    }

    //suppression d'un user
    public function deleteUser(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep('DELETE FROM user WHERE user_id= ?', $this->id);
    }

    //creation d'un user
    public function createUser(){
        
        return $this->execReqPrep('INSERT INTO USER VALUES (?,?,?,?,?);', [$this->name, $this->email, $this->pwd, $this->status, $this->createAt]);
    }


    /*****************************
        modification d'un user 
    ******************************/

    public function setEmail($email){
        return $this->email = $email;
    }

    public function setName($name){
        return $this->name = $name;
    }

    public function setPassword($pwd){
        return $this->pwd = $pwd;
    }

    public function setStatus($status){
        return $this->status = $status;
    }
}