<?php

require '../models/authorization.php';

$auth = new authorization();

$name = htmlspecialchars($_POST['username']);
$enc_password = $auth->encode(htmlspecialchars($_POST['password']));

if ($auth->validateUser($name, $enc_password)) {
    // $session = $auth->genSession($name);
    // $auth->openSession($session);
    database::getInstance()->closeConnection();

    $auth->redirect("../index.php?dashboard=$name");
    return;
}

$auth->redirect('../auth-login.html?login=false');