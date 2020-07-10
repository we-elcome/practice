<?php

require 'db_config.php';

class database
{
    private static $instance = null;
    private $connection = null;

    function __construct() {
        $this->connection = new mysqli(db_config::HOST, db_config::USER, db_config::PASSWORD, db_config::NAME);
    }

    public function getConnection() {
        return $this->connection;
    }

    public function closeConnection() {
        $this->connection->close();
        self::$instance = null;
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new database();
        }

        return self::$instance;
    }
}