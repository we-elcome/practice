<?php

require 'models/authorization.php';

$auth = new authorization();

if (isset($_GET['dashboard'])) {
    $name = htmlspecialchars($_GET['dashboard']);

    // TODO: session validation

    $db = database::getInstance();
    $connection = $db->getConnection();
}

$auth->redirect('auth-login.html');




