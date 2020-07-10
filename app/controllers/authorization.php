<?php

require '../models/Authorization.php';

$auth = new Authorization();

$name = htmlspecialchars($_POST['username']);
$enc_password = $auth->encode(htmlspecialchars($_POST['password']));

if ($auth->validateUser($name, $enc_password)) {
    // $session = $auth->genSession($name);
    // $auth->openSession($session);

    $auth->redirect("../index.php?dashboard=$name");
    return;
}

$auth->redirect('../auth-login.html?login=false');