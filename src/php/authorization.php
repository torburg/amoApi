<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header.php');

use Amo\Api\AmoApi;

if ($_POST) {
    if (!$_POST['login'] || !$_POST['password']) {
        echo "Заполните поля логин и пароль.";
    } else {
        $api = new AmoApi();
        $authorized = $api->authorization($_POST['login'], $_POST['password']);
        if ($authorized) {
            echo "authorized";
        } else {
            echo "Неверные данные авторизации";
        }
    }
}
