<?php
include $_SERVER['DOCUMENT_ROOT'] . '/header.php';
use \Amo\Api\AmoApi;

if ($_POST) {

    $amoApi = new AmoApi();
    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';

    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $call = [
        [
            'phone_number' => $_POST['phone_number'],
            'call_status' => $_POST['call_status'],
            'call_result' => $_POST['note_text'],
            'direction' => 'inbound'
        ]
    ];
    $response = $amoApi->add('calls', $call);
    $response = $response["_embedded"];
    if (array_key_exists('errors', $response)) {
        echo $response["errors"][0]['msg'];
    } else {
        echo "Звонок добавлен";
    }
}
