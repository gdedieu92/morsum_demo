<?php

class Database extends PDO {

    public function __construct() {
        parent::__construct
                (DB_TYPE . ':host=' . DB_HOST . ';charset=utf8;dbname=' . DB_NAME, DB_USER, DB_PASS);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    }

}
