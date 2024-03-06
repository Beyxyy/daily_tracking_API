<?php



class Request{

    static $data = "";

    public static function initContent(){
            $raw_data = file_get_contents('php://input');
            $data = json_decode($raw_data, true);
            if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
                return false;
            }
            self::$data = $data;
    }

}