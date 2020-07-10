<?php

require '../models/authorization.php';

$auth = new authorization();

$name = htmlspecialchars($_POST['username']);
$password = $auth->encode(htmlspecialchars($_POST['password']));

if ($auth->validateUser($name)) {
    $session = $auth->genSession($name);
    $auth->openSession($session);
    $auth->redirect("../index.php?dashboard=$name");
    return;
}

$auth->redirect('../auth-login.html?login=false');