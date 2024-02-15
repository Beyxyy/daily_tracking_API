<?php
require_once '.Model/Database.class.php';

class Route{

    private Database $database;

    public function __construct() {
        $this->database = new Database();
    }

    static function getRoute($url){
        return $database->execReqPrep("Select * from route where route_url=?;", array($url));
    }

    static getRoutes(){
        return $database->execReq("SELECT * FROM route;");
    }

    static getAuthRoute($url){
        return $database->execReqPrep('SELECT route_auth FROM route where route_url = ?;', array($url));
    }
    
    static setRoute($url, $method ,$auth){
        return $database->execReqPrep("INSERT INTO route VALUES (? ,?, ?);",array($url, $method, $auth));
    }
}