<?php
class DatabaseMultiple {

    static private $dbConf=array();

    static private function initDb($conf_name) {
        if (array_key_exists($conf_name, DatabaseMultiple::$dbConf)===false) {
            DatabaseMultiple::$dbConf[$conf_name]=array(
                "service"=>new DatabaseService(),
                "attr"=>new DatabaseAttribute(),
            );
        }
    }

    static private function checkDb($conf_name) {
        if (array_key_exists($conf_name, DatabaseMultiple::$dbConf)===false) {
            echo "db config error";
            exit(1);
        }
    }

    static public function getDbSchema($conf_name){
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->db_schema;
    }

    static public function setDbSchema($conf_name, $db_schema){
        DatabaseMultiple::initDb($conf_name);
        DatabaseMultiple::$dbConf[$conf_name]["service"]->db_schema = $db_schema;
    }

    static public function getDbHost($conf_name){
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->db_host;
    }

    static public function setDbHost($conf_name,$db_host){
        DatabaseMultiple::initDb($conf_name);
        DatabaseMultiple::$dbConf[$conf_name]["service"]->db_host = $db_host;
    }

    static public function getDbUser($conf_name){
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->db_user;
    }

    static public function setDbUser($conf_name,$db_user){
        DatabaseMultiple::initDb($conf_name);
        DatabaseMultiple::$dbConf[$conf_name]["service"]->db_user = $db_user;
    }

    static public function getDbPassword($conf_name){
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->db_password;
    }

    static public function setDbPassword($conf_name,$db_password){
        DatabaseMultiple::initDb($conf_name);
        DatabaseMultiple::$dbConf[$conf_name]["service"]->db_password = $db_password;
    }

    static public function getServerType($conf_name){
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["attr"]->server_type;
    }

    static public function setServerType($conf_name,$server_type){
        DatabaseMultiple::initDb($conf_name);
        DatabaseMultiple::$dbConf[$conf_name]["attr"]->server_type = $server_type;
    }

    static public function getDbType($conf_name){
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["attr"]->db_type;
    }

    static public function setDbType($conf_name,$db_type){
        DatabaseMultiple::initDb($conf_name);
        DatabaseMultiple::$dbConf[$conf_name]["attr"]->db_type = $db_type;
    }

    /**
     * DB接続する
     */
    static public function connect($conf_name) {
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->connect();
    }

    /**
     * SQLを実行する
     */
    static public function query($conf_name, $sql, $params=null) {
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->query($sql, $params);
    }

    /**
     * SQLを実行する
     */
    static public function queryOne($conf_name, $sql, $params=null) {
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->queryOne($sql, $params);
    }

    /**
     * SQLを実行する
     */
    static public function execute($conf_name, $sql, $params=null) {
        DatabaseMultiple::checkDb($conf_name);
        return DatabaseMultiple::$dbConf[$conf_name]["service"]->execute($sql, $params);
    }
}

// DB接続する
//DatabaseMultiple::connect("master");