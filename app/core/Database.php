<?php

require_once 'DbConfig.php';

class Database
{
    private static $instance = null;
    private $connection;

    private function openConnection() {
        $this->connection = new mysqli(DbConfig::HOST, DbConfig::USER, DbConfig::PASSWORD, DbConfig::NAME);
    }

    private function closeConnection() {
        $this->connection->close();
    }

    public function query($query) {
        $this->openConnection();

        $result = $this->connection->query($query)
            or die(mysqli_error($this->connection));

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $result->close();
        $this->closeConnection();
        return $data;
    }

    public function escapeString($str) {
        $this->openConnection();
        $result = $this->connection->real_escape_string($str);
        $this->closeConnection();
        return $result;
    }

    public static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}