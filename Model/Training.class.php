<?php

require_once './Model/Database.class.php';

class Training extends Database{

    private $userId;
    private $id;
    private $createdAt;
    
    public function __construct($id = false){
        $this->id = $id;
        $this->createdAt = new DatetimeImmutable();
    }


    public function createTraining(){
        if($this->id){
            return;
        }   
        $this->execReqPrep("INSERT INTO training VALUES (?, ?);", [$this->userId, $this->createdAt]);
    }

    public function getTraining(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT * FROM training WHERE training_id = ?;", $this->id);
    }


    public function EnregTrainingExercice($exercice, $rep, $weight, $rest=NULL){
        if(!$this->id){
            return;
        }
        $this->execReqPrep("INSERT INTO training_exercice VALUES (?, ?, ?, ?, ?);", [$this->id, $exercice, $rep, $weight, $rest]);
    }

    public function getTrainingExercice(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT * FROM training_exercice WHERE training_id = ?;", $this->id);
    }


}