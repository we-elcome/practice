<?php

require '../models/authorization.php';

$auth = new authorization();

$name = htmlspecialchars($_POST['username']);
$password = $auth->encode_password(htmlspecialchars($_POST['password']));

if (true /* $auth->find_user($name) */) {
    // SQL-запрос
    if (true /* проверка на соответствие паролей */) {
        //$session = $auth->gen_session($name);
        //$auth->open_session($session);
        $auth->redirect("../index.php?dashboard=$name");
        return;
    }
}

$auth->redirect('../auth-login.html?login=false');