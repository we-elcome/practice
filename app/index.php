<?php

require 'models/authorization.php';

$auth = new authorization();

if (isset($_GET['dashboard'])) {
    $name = htmlspecialchars($_GET['dashboard']);
    exit;
    // TODO: session validation
}

$auth->redirect('auth-login.html');




