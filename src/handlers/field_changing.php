<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

if ($_POST['entity_id'] && $_POST['entity_code'] && $_POST['field_text']) {

    $login = 'mfilippov@team.amocrm.com';
    $hash = '4f2e1172393444687df0487b3d5c10286f8e00ee';

    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $entity_id = $_POST['entity_id'];
    $entity_code = $_POST['entity_code'];
    $field_text = $_POST['field_text'];

    $entities = [
        1 	=> 'contacts',
        2 	=> 'leads',
        3 	=> 'companies',
        4 	=> 'tasks',
        12 	=> 'customers',
    ];
    $entity = $entities[$entity_code];

    //get all custom fields
    $params = "with=custom_fields";
    $response = $amoApi->get("account", $params);
    $custom_fields = $response["_embedded"]['custom_fields'][$entity];
    $field_id = -1; //field id should be positive
    foreach ($custom_fields as $custom_field) {
        if ($custom_field['field_type'] == 1) {// 1 - text field
            $field_id = $custom_field['id'];
            break;
        }
    }
    if ($field_id < 0) {
        echo "У данного элемента нет текстового поля"; die;
    }
    $entity_to_update = [];
    $entity_to_update['id'] = $entity_id;
    $entity_to_update['updated_at'] = time();
    $entity_to_update['custom_fields'] = [
        [
            'id' => $field_id,
            'values' => [
                [
                    'value' => $field_text
                ]
            ]
        ]
    ];
    $response = $amoApi->update($entity, [$entity_to_update])['_embedded'];
    if (!array_key_exists("errors", $response)) {
        echo "Поле обновлено"; die;
    } else {
        echo "Неверный ID и/или сущность"; die;
    }
}