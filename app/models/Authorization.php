<?php

// TODO: вынести повторяющиеся блоки кода в отдельный метод Database.php

require_once '../core/Database.php';

class Authorization
{
    public function encode($str) {
        return md5($str);
    }

    public function findUser($name): bool {
        $db = database::getInstance();

        $query = sprintf("SELECT * 
                          FROM app_user 
                          WHERE login = '%s'",
            $db->escapeString($name));

        $result = $db->query($query);

        return count($result) != 0;
    }

    public function validateUser($name, $enc_pwd) {
        $db = database::getInstance();

        $query = $query = sprintf("SELECT * 
                                   FROM app_user 
                                   WHERE login = '%s' and password= '%s'",
            $db->escapeString($name),
            $db->escapeString($enc_pwd));

        $result = $db->query($query);

        return count($result) != 0;
    }

    public function openSession($session) {
        throw new Exception('Not supported yet');
    }

    public function genSession($name): string {
        throw new Exception('Not supported yet');

        $db = database::getInstance();

        $session = ''; // SessionID generation

        $query = sprintf("UPDATE app_user 
                          SET session_ID = '%s' 
                          WHERE Login = '%s'",
                    $session,
                    $db->escapeString($name));

        $connection->query($query);

        return $session;
    }

    public function validateSession($name, $session): bool {
        $db = database::getInstance();

        $query = sprintf("SELECT *
                          FROM app_user 
                          WHERE login = '%s', sessionID = '%s'",
                    $db->escapeString($name),
                    $db->escapeString($session));

        $result = $db->query($query);

        return count($result) == 1;
    }

    public function redirect($url) {
        header("Location: $url");
    }
}
