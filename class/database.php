<?php

include "action.php";
include "./config/config.php";

class Database extends Action {

    protected $connection;

    public function __construct() {
        $this->database();
    }

    public function database() {

        $connection =  $this->connection = new Mysqli(DB[0],DB[1],DB[2],DB[3]);

        if($connection->error) {
            die("Connection failed " . $this->connection->errorno . $this->connection->error);
        }
    }

    public function query($sql) {
        
        $query = $this->connection->query($sql);
        return $query;
    }

    public function escape($string) {
        return $this->connection->escape_string($string);
    }
}



?>