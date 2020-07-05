<?php
class DatabaseAttribute {

    const SERVER_TYPE_NO = 0;
    const SERVER_TYPE_MASTER = 1;
    const SERVER_TYPE_SLAVE = 2;

    private $server_type = DatabaseAttribute::SERVER_TYPE_NO;

    const DB_TYPE_NO = 0;
    const DB_TYPE_INNODB = 1;
    const DB_TYPE_MYISAM = 2;

    private $db_type = DatabaseAttribute::DB_TYPE_NO;

    public function getServerType(){
        return $this->server_type;
    }

    public function setServerType($server_type){
        $this->server_type = $server_type;
    }

    public function getDbType(){
        return $this->db_type;
    }

    public function setDbType($db_type){
        $this->db_type = $db_type;
    }
}
