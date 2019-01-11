<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use \Amo\Api\AmoApi;
#@ToDo stay on these page if response error

if ($_POST['entity_id'] && $_POST['entity_code'] && $_POST['note_text']) {

    $amoApi = new AmoApi();
    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';

    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $entity_id = $_POST['entity_id'];
    $entity_code = $_POST['entity_code'];
    $note_text = $_POST['note_text'];

//    we cannot get customers list
//    {
//        type: https://www.amocrm.ru/developers/,
//        title: "Error",
//        detail: "Functional disabled by administrator",
//        status: 426
//    }

    $entity = ENTITIES[$entity_code];

    $note = [
        [
            'element_id' => $entity_id,
            'element_type' => $entity_code,
            'text' => $note_text
        ]
    ];

    $params = 'id=' . $entity_id;
    $response = $amoApi->get($entity, $params);
    if (array_key_exists("_embedded", $response)) {
        $amoApi->add('notes', $note);
        echo "Ваше примечание добавлено";
    } else {
        echo "ID сущности и её тип не совпадают";
    }

}
