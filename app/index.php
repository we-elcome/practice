<?php

require 'models/Authorization.php';

$auth = new Authorization();

if (isset($_GET['dashboard'])) {
    $name = htmlspecialchars($_GET['dashboard']);

    // TODO: session validation
    throw new Exception('Not supported yet');

    $db = database::getInstance();
    $connection = $db->getConnection();
    $session = $_SESSION['' /* key */];
    if ($auth->validateSession($name, $session)) {
        echo 'вы авторизированы в системе';
        $db->closeConnection();
        return;
    }

    $db->closeConnection();
}

$auth->redirect('auth-login.html');




