<?php

// TODO: вынести повторяющиеся блоки кода в отдельный метод database.php

require '../core/database.php';

class Authorization
{
    public function encode($str) {
        return md5($str);
    }

    public function findUser($name): bool {
        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "SELECT * 
                  FROM `app_user` 
                  WHERE `Логин`=$name";
        $data = $db->query($query);

        return $data != null;
    }

    public function validateUser($name, $enc_pwd) {
        throw new Exception('Not supported yet');

        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "SELECT *
                  FROM `app_user` 
                  WHERE `Логин`=$name, `Пароль`=$enc_pwd";
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

        $query = "UPDATE `app_user`
                  SET `Идентификатор сессии`=$session 
                  WHERE `Логин`=$name";
        $connection->query($query);

        return $session;
    }

    public function validateSession($name, $session): bool {
        throw new Exception('Not supported yet');

        $db = database::getInstance();
        $connection = $db->getConnection();

        $query = "SELECT *
                  FROM `app_user` 
                  WHERE `Логин`=$name, `Идентификатор сессии`=$session";
        $result = $connection->query($query);
        $row = $result->fetch_assoc();
        $result->close();

        return $row != null;
    }

    public function redirect($url) {
        header("Location: $url");
    }
}
