<?php

require_once($_SERVER['DOCUMENT_ROOT'] . '/models/Authentication.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/utils/EscapeUtils.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/models/utils/ValidateUtils.php');

$auth = new Authentication();

$name = EscapeUtils::escape_login($_POST['username']);
$password = EscapeUtils::escape_password($_POST['password']);
$enc_password = $auth->hash($password);

if ($auth->validate_user($name, $enc_password)) {
    $auth->open_session($name);
    $auth->redirect("../index.php?dashboard=$name");
    return;
}

$auth->redirect('../auth-login.html?login=false');