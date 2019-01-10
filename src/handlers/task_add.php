<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

if ($_POST['entity_id'] &&
    $_POST['entity_code'] &&
    $_POST['complete_till_at'] &&
    $_POST['responsible_user_id'] &&
    $_POST['task_text']) {

    echo $_POST['complete_till_at'];

    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';
    $amoApi = new AmoApi();
    dump($amoApi->authorization($login, $hash));

    $entity_id = $_POST['entity_id'];
    $entity_code = $_POST['entity_code'];
    $complete_till_at = $_POST['complete_till_at'];
    $responsible_user_id = $_POST['responsible_user_id'];
    $task_text = $_POST['task_text'];

    $entities = [
        1 	=> 'contacts',
        2 	=> 'leads',
        3 	=> 'companies',
        4 	=> 'tasks',
        12 	=> 'customers',
    ];
    $entity = $entities[$entity_code];

    $params = 'id=' . $entity_id;
    $response = $amoApi->get($entity, $params);
}
