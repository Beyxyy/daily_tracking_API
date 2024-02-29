<?php

class CtrlTraining{

    private $id;
    private $training;
    private $response;
    private $exercice;


    public function __construct($id=false){
        $this->id = $id;
        $this->response = new Response();
        if($this->id){
            $this->training = new Training();
        }
        else{
            $this->training = new Training($this->id);
        }
        
    }


    //create a new training
    public function createTraining(){
        try{
            $data = Request::$data;
            if(!$data){
                throw new Exception('Values Invalid no data send');
                return;
            }

            extract(Request::$data);

            if(!isset($ExerciceID) and !isset($ExerciceRep) and !isset($ExerciceWeight) and !isset($ExerciceRest)){
                throw new Exception('Values Necessary for this endpoint are missing, please check you sent required data');
                return;
            }

            if(!is_int($ExerciceID) and !is_int($ExerciceRep) and !is_float($ExerciceWeight) and !is_float($ExerciceRest)){
                throw new Exception('Values Invalid for this endpoint please check the variables\'s types');
                return;
            }

            $this->training->EnregTrainingExercice($ExerciceID, $ExerciceRep, $ExerciceWeight, $ExerciceRest, Token::$userId);
        }
        catch (Exception $e) {
            $this-> response -> setMessage($exception->getMessage())
                             -> setCode($exception->getCode())
                             -> sendResponse();
            return false;
        }
    }


    //get all trainings
    public function getTrainingsByUser(){
        try{
            if(!is_int($userID)){
                throw new Exception('Values Invalid for this endpoint, please check the variables\'s types');
                return;
            }
            $this->training->getTrainings($userID);
            $this->response->setData($this->training->getTrainings($userID))
                           -> sendResponse();

        }
        catch (Exception $e) {
            $this-> response -> setMessage($exception->getMessage())
                              -> setCode($exception->getCode())
                              -> sendResponse();
            return false;
        }
    }

    public function getTrainingWorkout(){
        try{
            User::getID();
            $this->training->getTrainingWorkout();
            
        }
        catch(Exception $e){
            $this-> response -> setMessage($exception->getMessage())
                             -> setCode($exception->getCode())
                             -> sendResponse();
            return false;
        }
    } 

    public function setExercice(){

    }

    
}