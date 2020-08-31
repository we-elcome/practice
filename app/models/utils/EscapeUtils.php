<?php


class EscapeUtils
{
    public static function escape_login($name) {
        return preg_replace("/\s/", "", $name);
    }

    public static function escape_password($password) {
        return trim($password);
    }
    
    public static function escape_phone($phone) {
        $phone = preg_replace("/\D/", "", trim($phone));
        return ($phone[0] == 7) ? 8 . substr($phone, 1) : $phone;
    }

    public static function escape_email($email) {
        return strtolower(trim($email));
    }
}