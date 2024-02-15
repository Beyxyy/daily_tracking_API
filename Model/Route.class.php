<?php
require_once '../Model/Database.class.php';

class Route extends Database{
    
    static function getRoute($url){
        return self::execReqPrep("Select * from route where route_url=?;", array($url));
    }

    static function getRoutes(){
        return self::execReq("SELECT route_url FROM route;");
    }

    static function getAuthRoute($url){
        return self::execReqPrep('SELECT route_auth FROM route where route_url = ?;', array($url));
    }
    
    static function setRoute($url, $method ,$auth){
        return self::execReqPrep("INSERT INTO route VALUES (? ,?, ?);",array($url, $method, $auth));
    }
}