<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

if ($_POST['element_id'] > 0 && $_POST['entity_code'] && $_POST['field_text']) {

    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';

    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

    $element_id = $_POST['element_id'];
    $entity_code = $_POST['entity_code'];
    $field_text = $_POST['field_text'];

    $entity = ENTITIES[$entity_code];

    //get all custom fields
    $params = "with=custom_fields";
    $response = $amoApi->get("account", $params);
    $custom_fields = $response["_embedded"]['custom_fields'][$entity];
    $field_id = -1; //field id should be positive
    $field_name = '';
    foreach ($custom_fields as $custom_field) {
        if ($custom_field['field_type'] == 1) {// 1 - text field
            $field_id = $custom_field['id'];
            $field_name = $custom_field['name'];
            break;
        }
    }
    if ($field_id < 0) {
        echo "У данной сущности нет текстового поля"; die;
    }
    $entity_to_update = [
        [
            'id' => $element_id,
            'updated_at' => time(),
            'custom_fields' => [
                [
                    'id' => $field_id,
                    'values' => [
                        [
                            'value' => $field_text
                        ]
                    ]
                ]
            ]
        ]
    ];
    $response = $amoApi->update($entity, $entity_to_update)['_embedded'];
    if (!array_key_exists("errors", $response)) {
        echo "Значение поля обновлено";
    } else {
        echo $amoApi->errors_handler($response['errors']);
    }
}