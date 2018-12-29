<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use \Amo\Api\AmoApi;

if ($_POST) {

    $amoApi = new AmoApi();
    $login = 'mfilippov@team.amocrm.com';
    $hash = '46dc105cf215a952995d55378d858bedf78fd024';

    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $entity_id = $_POST['entity_id'];
    $entity_code = $_POST['entity_code'];
    $note_text = $_POST['note_text'];

    $entities = [
        1 	=> 'contacts',
        2 	=> 'leads',
        3 	=> 'companies',
        4 	=> 'tasks',
        12 	=> 'customers',
    ];
    $entity = $entities[$entity_code];

    $note = [
        [
            'element_id' => $entity_id,
            'element_type' => $entity_code,
            'text' => $note_text
        ]
    ];
    $params = 'id=' . $entity_id;
    $amoApi->get($entity, $params);
    $amoApi->add('notes', $note);
    echo "Ваше примечание добавлено";
}