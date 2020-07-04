<?php
class Db {
    static private $dbh;

    /**
     * DB接続する
     */
    static public function connect() {
        // ドライバ呼び出しを使用して MySQL データベースに接続します
        $db_schema = Database::getDbSchema();
        $db_host = Database::getDbHost();
        $db_dsn = "mysql:dbname={$db_schema};host={$db_host}";
        $db_user = Database::getDbUser();
        $db_password = Database::getDbPassword();
        try {
            Db::$dbh = new PDO($db_dsn, $db_user, $db_password);
        } catch (PDOException $e) {
            echo "接続失敗: " . $e->getMessage() . "\n";
            exit();
        }
    }

    /**
     * SQLを実行する
     */
    static public function query($sql, $params=null) {
        $sth = Db::_execute($sql, $params);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * SQLを実行する
     */
    static public function execute($sql, $params=null) {
        Db::_execute($sql, $params);
    }

    /**
     * SQLを実行する
     */
    static private function _execute($sql, $params=null) {
        $work_params=$params;
        if ($work_params !== null && is_array($work_params)) {
            foreach ($work_params as $key => $val) {
                if (preg_match('/^(#)([a-zA-Z0-9\_]+)(#)$/', $key, $m) && count($m)==4) {
                    str_replace(":{$m[2]}", $val, $sql);
                    unset($work_params[$key]);
                }
            }
        }
        $prepare = Db::$dbh->prepare($sql);
        if ($work_params !== null && is_array($work_params)) {
            foreach ($work_params as $key => $val) {
                $prepare->bindValue(":{$key}", "$val");
            }
        }
        $prepare->execute();
        return $prepare;
    }
}

// DB接続する
Db::connect();