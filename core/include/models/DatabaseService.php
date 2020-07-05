<?php
class DatabaseService {
    private $db_schema = "";
    private $db_host = "";
    private $db_user = "";
    private $db_password = "";

    private $dbh;

    public function getDbSchema(){
        return $this->db_schema;
    }

    public function setDbSchema($db_schema){
        $this->db_schema = $db_schema;
    }

    public function getDbHost(){
        return $this->db_host;
    }

    public function setDbHost($db_host){
        $this->db_host = $db_host;
    }

    public function getDbUser(){
        return $this->db_user;
    }

    public function setDbUser($db_user){
        $this->db_user = $db_user;
    }

    public function getDbPassword(){
        return $this->db_password;
    }

    public function setDbPassword($db_password){
        $this->db_password = $db_password;
    }

    /**
     * DB接続する
     */
    public function connect() {
        // ドライバ呼び出しを使用して MySQL データベースに接続します
        $db_schema = $this->getDbSchema();
        $db_host = $this->getDbHost();
        $db_dsn = "mysql:dbname={$db_schema};host={$db_host}";
        $db_user = $this->getDbUser();
        $db_password = $this->getDbPassword();
        try {
            $this->dbh = new PDO($db_dsn, $db_user, $db_password);
        } catch (PDOException $e) {
            echo "接続失敗: " . $e->getMessage() . "\n";
            exit();
        }
    }

    /**
     * SQLを実行する
     */
    public function query($sql, $params=null) {
        $sth = $this->_execute($sql, $params);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * SQLを実行する
     */
    public function queryOne($sql, $params=null) {
        $sth = $this->_execute($sql, $params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * SQLを実行する
     */
    public function execute($sql, $params=null) {
        $this->_execute($sql, $params);
    }

    /**
     * SQLを実行する
     */
    private function _execute($sql, $params=null) {
        $work_params=$params;
        if ($work_params !== null && is_array($work_params)) {
            foreach ($work_params as $key => $val) {
                if (preg_match('/^(#)([a-zA-Z0-9\_]+)(#)$/', $key, $m) && count($m)==4) {
                    str_replace(":{$m[2]}", $val, $sql);
                    unset($work_params[$key]);
                }
            }
        }
        $prepare = $this->dbh->prepare($sql);
        if ($work_params !== null && is_array($work_params)) {
            foreach ($work_params as $key => $val) {
                $prepare->bindValue(":{$key}", "$val");
            }
        }
        $prepare->execute();
        return $prepare;
    }
}
