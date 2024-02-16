<?php

class Exercice extends Database{

    private $id = false;
    private $name = null;
    private $targetMuscle = null;

    public function __construct($id =false){
        $this->id=$id;
        if(!$this->id && $this->getExercice($this->id) != false){
            $this->name = $this->getName();
            $this->type = $this->getType();
            $this->targetMuscle = $this->getTargetMuscle();
        }
        return;
    }

    public function getExercice(){
        if(!$this->id){
            return;
        }
        return $this->execReqPrep("SELECT * FROM exercice WHERE exercice_id = ?;", !$this->id);
    }

    public function getName(){
        if($this->name){
            return $this->name;
        }
        return $this->id ? $this->execReqPrep('SELECT exercice_name FROM exercice WHERE exercice_id', [$this->id]) : false;
    }

    public function getTargetMuscle(){
        if($this->targetMuscle){
            return $this->targetMuscle;
        }
        return $this->id ? $this->execReqPrep('SELECT exercice_targetMuscle FROM exercice WHERE exercice_id', [$this->id]) : false;
    }

    public function getId(){
        if($this->id){
            return $this->id;
        }
        return false;
    }

    public function setName($name){
        return $this->name = $name;
    }


    public function createExercice(){
        if($this->name==null or $this->targetMuscle==null){
            return false;
        }
        return $this->execReqPrep("INSERT INTO exercice VALUES (?,?);", [$this->name, $this->targetMuscle]);
    }

    public function updateExercice(){
        if(!$this->id){
            return false;
        }
        return $this->execReqPrep("UPDATE exercice SET exercice_name=?, exercice_targetMuscle = ? WHERE exercice_id=?;", [$this->name, $this->targetMuscle, $this->id]);
    }

    public function addExerciceTraining($trainingId){
        $training = new Training($trainingId);
        if($training !=false and $this->id != false){
            $this->execReqPrep("INSERT INTO training_exercice VALUES (?,?);", [$training->id, $this->id]);
        }
        return false;
    }

}