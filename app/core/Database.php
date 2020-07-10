<?php

require_once 'DbConfig.php';

class Database
{
    private static $instance = null;
    private $connection;

    private function openConnection() {
        $this->connection = new mysqli(dbConfig::HOST, dbConfig::USER, dbConfig::PASSWORD, dbConfig::NAME);
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