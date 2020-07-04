<?php
class Database {
    static private $db_schema = "";
    static private $db_host = "";
    static private $db_user = "";
    static private $db_password = "";

    static public function getDbSchema(){
        return Database::$db_schema;
    }

    static public function setDbSchema($db_schema){
        Database::$db_schema = $db_schema;
    }

    static public function getDbHost(){
        return Database::$db_host;
    }

    static public function setDbHost($db_host){
        Database::$db_host = $db_host;
    }

    static public function getDbUser(){
        return Database::$db_user;
    }

    static public function setDbUser($db_user){
        Database::$db_user = $db_user;
    }

    static public function getDbPassword(){
        return Database::$db_password;
    }

    static public function setDbPassword($db_password){
        Database::$db_password = $db_password;
    }
}