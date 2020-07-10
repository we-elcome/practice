<?php

require_once 'db_config.php';

class database
{
    private static $instance = null;
    private $connection;

    private function openConnection() {
        $this->connection = new mysqli(db_config::HOST, db_config::USER, db_config::PASSWORD, db_config::NAME);
    }

    private function closeConnection() {
        $this->connection->close();
    }

    public function query($query) {
        $this->openConnection();

        $result = $this->connection->query($query, "SET NAMES 'utf-8'")
            or die(mysqli_error($connection));

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $result->close();
        $this->closeConnection();
        return $data;
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}