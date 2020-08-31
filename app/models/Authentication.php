<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/Database.php');

class Authentication
{
    public function find_user($name): bool
    {
        $db = Database::get_instance();

        $query = sprintf("SELECT * 
                          FROM users_auth 
                          WHERE login = '%s'",
            $db->escape_string($name));


        $result = $db->query($query);

        return !empty($result);
    }

    public function validate_user($name, $pwd): bool
    {
        $db = Database::get_instance();

        $query = $query = sprintf("SELECT password 
                                   FROM users_auth 
                                   WHERE username = '%s'",
            $db->escape_string($name));

        $result = $db->query($query);

        return !empty($result) and password_verify($pwd, $result["password"]);
    }

    public function open_session($name): void
    {
        session_start();
        $_SESSION['username'] = $name;
    }

    public function validate_session($id): bool
    {
        return $id === $_SESSION['username'];
    }

    public function register($username, $email, $phone, $password, $role=0)
    {
        $db = Database::get_instance();

        $query = sprintf("INSERT INTO users_auth (username, password)
			              VALUES ('%s', '%s')", $username, $password);

        $db->query_add($query);

        $interal_key_id = Database::get_id_by_name($username);

        $query = sprintf("INSERT INTO users_attributes 
                            (role,
                            date_created, 
                            date_updated, date_last_login, full_name,
                            email, phone, internal_key_id) VALUES 
			               ('%s', 
			                UNIX_TIMESTAMP(), 
			                UNIX_TIMESTAMP(), 
			                UNIX_TIMESTAMP(), '', '%s', '%s', '%s')",
                    $role, $email , $phone, $interal_key_id);

        $db->query_add($query);
    }

    public static function redirect($url)
    {
        header("Location: $url");
    }
}