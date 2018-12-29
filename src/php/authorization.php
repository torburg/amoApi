<?php
require($_SERVER['DOCUMENT_ROOT'] . '/header.php');

use Amo\Api\AmoApi;

if ($_POST) {
    $amoApi = new AmoApi();
    $authorized = $amoApi->authorization($_POST['login'], $_POST['password']);
    if ($authorized) {
        echo "authorized";
    } else {
        echo "Неверные данные авторизации";
    }
}
