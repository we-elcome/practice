<?php

require '../core/database.php';

class authorization
{
    public function encode($str) {
        return $this->encode($str);
    }

    public function findUser($name): bool {
        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "SELECT Логин 
                  FROM app_user 
                  WHERE Логин=$name";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $result->close();

        return $row != null;
    }

    public function validateUser($name, $enc_pwd) {
        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "SELECT Логин 
                  FROM app_user 
                  WHERE Логин=$name, Пароль=$enc_pwd";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $result->close();

        return $row != null;
    }

    public function openSession($session) {
        throw new Exception('Not supported yet');
    }

    public function genSession($name): string {
        throw new Exception('Not supported yet');

        $session = ''; // SessionID generation

        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "UPDATE app_user
                  SET Session=$session 
                  WHERE Логин=$name";
        $result = $connection->query($query);

        return $session;
    }

    public function validateSession($name, $session) {
        throw new Exception('Not supported yet');

        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "SELECT Логин, Session 
                  FROM app_user 
                  WHERE Логин=$name, Session=$session";
        $result = $connection->query($query);
    }

    public function redirect($url) {
        header("Location: $url");
    }
}
