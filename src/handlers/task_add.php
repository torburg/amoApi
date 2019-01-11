<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

if ($_POST['entity_id'] &&
    $_POST['entity_code'] &&
    $_POST['complete_till_at'] &&
    $_POST['responsible_user_id'] &&
    $_POST['task_text']) {

    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';
    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $element_id = $_POST['entity_id'];
    $entity_code = $_POST['entity_code'];
    $complete_till_at = $_POST['complete_till_at'];
    $responsible_user_id = $_POST['responsible_user_id'];
    $task_text = $_POST['task_text'];

    
    $entity = ENTITIES[$entity_code];

    //get all users
    $params = "with=users";
    $response = $amoApi->get('account', $params)["_embedded"]["users"];
    $users_ids = [];
    foreach ($response as $item){
        $users_ids[] = $item['id'];
    }
    if(!in_array($responsible_user_id, $users_ids)) {
        echo "Такого пользователя не существует"; die;
    }

    $task = [
        [
            'element_id' => $element_id,
            'element_type' => $entity_code,
            'complete_till_at' => $complete_till_at,
            'responsible_user_id' => $responsible_user_id,
            'text' => $task_text
        ]
    ];

    $response = $amoApi->add("tasks", $task);
    if (array_key_exists('errors', $response)) {
        echo $response["errors"][0]['msg'];
    } else {
        echo "Задача добавлена";
    }
}
