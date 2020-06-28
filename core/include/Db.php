<?php
class Db {
    static private $dbh;

    /**
     * DB接続する
     */
    static public function connect() {
        // ドライバ呼び出しを使用して MySQL データベースに接続します
        $dbname = Config::getDbName();
        $host = Config::getHost();
        $dsn = "mysql:dbname={$dbname};host={$host}";
        $user = Config::getUser();
        $password = Config::getPassword();
        try {
            Db::$dbh = new PDO($dsn, $user, $password);
        } catch (PDOException $e) {
            echo "接続失敗: " . $e->getMessage() . "\n";
            exit();
        }
    }

    /**
     * SQLを実行する
     */
    static public function query($sql, $params=null) {
        $prepare = Db::_execute($sql, $params);
        return $prepare->fetchAll(PDO::FETCH_ASSOC);
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