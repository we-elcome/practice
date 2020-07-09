<?php

// require '../core/config.php';

class authorization
{
    private function encode($string) {
        return md5($string);
    }

    public function encode_password($password) {
        return $this->encode($password);
    }

    public function find_user($name): bool {
        throw new Exception('Unsupported operation');

        // $query = "SELECT Логин FROM app_user WHERE Логин=$name";

    }

    public function open_session($session) {
        throw new Exception('Not supported yet');
    }

    public function gen_session($name): string {
        throw new Exception('Not supported yet');

        // $query = "UPDATE app_user SET Session=$session WHERE Логин=$name";
    }

    public function validate_session($name, $session) {
        throw new Exception('Not supported yet');

        // $query = "SELECT Логин, Session FROM app_user WHERE Логин=$name, Session=$session";
    }

    public function redirect($url) {
        header("Location: $url");
    }
}
