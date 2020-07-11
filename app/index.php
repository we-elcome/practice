<?php

require 'models/Authorization.php';

$auth = new Authorization();

if (isset($_GET['dashboard'])) {
    $name = htmlspecialchars($_GET['dashboard']);

    // TODO: session validation
    throw new Exception('Not supported yet');

    $db = database::getInstance();
    $session = $_SESSION['' /* key */];
    if ($auth->validateSession($name, $session)) {
        echo 'вы авторизированы в системе';
        return;
    }
}

$auth->redirect('auth-login.html');




