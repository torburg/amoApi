<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '2e39d1a98868c0f5dba770757150480a1c936685';
$amoApi = new AmoApi();
dump($amoApi->authorization($login, $hash));

dump($amoApi->get('tasks'));
$params = [
    [
        'id' => 0,
        'text' => 'Finished',
        'updated_at' => time(),
        'is_completed' => TRUE,
    ]
];
$response = $amoApi->update("tasks", $params);
dump($response);