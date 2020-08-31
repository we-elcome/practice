<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/core/Database.php');

class ValidateUtils
{
    public static function validate_login($name) : bool {
        return (bool) preg_match("/^[\wа-яА-ЯёЁ+=-].{3,}$/", $name);
    }

    public static function validate_password($password) : bool {
        return (bool) preg_match("/(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9])^(.+){8,}$/", $password);
    }

    public static function validate_passwords($pwd1, $pwd2) : bool {
        return $pwd1 === $pwd2;
    }

    public static function validate_phone($phone) : bool {
        return (bool) preg_match("/^8\d{10}$/", $phone);
    }

    public static function validate_email($email) : bool {
        return (bool) preg_match("/[\w.-]+@[\w.-]+\.\w+/", $email);
    }

    public static function user_exists($name) {
        return Database::exists($name, "username", "users_auth");
    }

    public static function email_exists($email) {
        return Database::exists($email, "email", "users_attributes");
    }

    public static function phone_exists($phone) {
        return Database::exists($phone, "phone", "users_attributes");
    }
}