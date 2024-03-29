<?php

class User extends Database{

    private  $id        = false;
    private  $name      = null;
    private  $email     = null;
    private  $password  = null;
    private  $createdAt = null;
    private  $status    = null;
    // private string|null 


    public function __construct($id = false){
        $this->id = $id;
        if(!$this->id){
            $this->name = $this->getName();
            $this->email = $this->getEmail();
            $this->password = $this->getPassword();
            $this->role = $this->getRole();
            $this->createdAt = new DatetimeImmutable();
        }

    }

    public function getId(){
        return $this->id;
    }

    public function getCreatedAt(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT user_createdAt from user WHERE user_id = ?;", $this->id);
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

    public function getRole(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT user_role from user WHERE user_id = ?;", $this->id);
    }

    public function authenticateUser($email, $password){
        if(empty($email) and empty($password)){
            return;
        }
        return $this->execReqPrep("SELECT user_id FROM user WHERE user_email = ? AND user_password = ?", [$email, $password]); 
    }

    //récupération d'un seul user à partir de son id
    public function getUser(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("Select user_id, user_username, user_email, user_createdAt, user_role from user WHERE user_id = ?;", $this->id);

    }

    //récupération de tous les users
    public function getUsers(){
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
        return $this->password = $pwd;
    }

    public function setStatus($status){
        return $this->status = $status;
    }


    /*******************
     * vérification du user
     */
    public function authenticate(){
        if(empty($this->email) and empty($this->password)){
            return false;
        }
        $result = $this->execReqPrep("SELECT user_id FROM user WHERE user_email = ? AND user_password = ?", [$this->email, $this->password]);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
}