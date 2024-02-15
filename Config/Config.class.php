<?php

class Config{

    const HOST = $_ENV['DBHOST'];
    const PWD = $_ENV['DBPWD'];
    const USER = $_ENV['DBUSER'];
    const SECRET_KEY = $_ENV['KEY_ENC'];
    const DBNAME = $_ENV['DBNAME'];
}