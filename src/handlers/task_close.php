<?php
include $_SERVER['DOCUMENT_ROOT'] . '/header.php';
use \Amo\Api\AmoApi;

if ($_POST['task_id']) {

    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';
    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $params = [
        [
            'id' => $_POST['task_id'],
            'text' => 'Finished',
            'updated_at' => time(),
            'is_completed' => TRUE,
        ]
    ];
    $response = $amoApi->update("tasks", $params);
    if (!array_key_exists("errors", $response)) {
        echo "Задача закрыта";
    } else {
        echo "Задача не закрыта";
    }
}
