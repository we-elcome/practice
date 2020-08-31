<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/Config.php');

class Database
{
    private static $instance = null;
    private $connection;

    private function __construct() {}

    private function clone() {}

    private function open_connection() : void
    {
        $this->connection = new mysqli(Config::HOST, Config::USER, Config::PASSWORD, Config::NAME);
    }

    private function close_connection() : void
    {
        $this->connection->close();
    }

    public function query_add($query)
    {
        $this->open_connection();

        $this->connection->query($query)
            or die(mysqli_error($this->connection));

        $this->close_connection();
    }

    public function query($query) : array
    {
        $this->open_connection();

        $result = $this->connection->query($query)
            or die(mysqli_error($this->connection));

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        $result->close();
        $this->close_connection();
        return $data;
    }

    public function escape_string($str) : string
    {
        $this->open_connection();
        $result = $this->connection->real_escape_string($str);
        $this->close_connection();
        return $result;
    }

    public static function exists($str, $label, $db_name) : bool
    {
        $db = self::get_instance();

        $query = sprintf("SELECT * 
                          FROM  %s
                          WHERE %s = '%s'",
            $db_name,
            $label,
            $str);

        $result = $db->query($query);

        return !empty($result);
    }

    public static function get_id_by_name($name)
    {
        $db = self::get_instance();
        $query = sprintf("SELECT * FROM users_auth WHERE username = '%s'", $name);
        $result = $db->query($query);

        return empty($result) ? null : $result[0]['id'];
    }

    public static function add_column($property)
    {
        $db = self::get_instance();
        $query = sprintf("ALTER TABLE users_roles 
                    ADD '%s' int(1) 
                    NOT NULL DEFAULT 0", $property);

        $db->query($query);
    }

    public static function get_instance() : Database
    {
        if (self::$instance == null) {
            self::$instance = new self();
        }

        return self::$instance;
    }
}