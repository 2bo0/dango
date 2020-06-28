<?php
class Config {
    static private $dbname = "dango";
    static private $host = "127.0.0.1";
    static private $user = "root";
    static private $password = "root";

    static public function getDbName(){
        return Config::$dbname;
    }

    static public function setDbName($dbname){
        Config::$dbname = $dbname;
    }

    static public function getHost(){
        return Config::$host;
    }

    static public function setHost($host){
        Config::$host = $host;
    }

    static public function getUser(){
        return Config::$user;
    }

    static public function setUser($user){
        Config::$user = $user;
    }

    static public function getPassword(){
        return Config::$password;
    }

    static public function setPassword($password){
        Config::$password = $password;
    }
}