<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '2e39d1a98868c0f5dba770757150480a1c936685';
//
$amoApi = new AmoApi();
dump($amoApi->authorization($login, $hash));

//$entity_id = 10226117;
//$entity_code = 3;
//$complete_till_at = "2019-01-11";
//$responsible_user_id = 3009898;
//$task_text = "test text";
//
//$entities = [
//    1 	=> 'contacts',
//    2 	=> 'leads',
//    3 	=> 'companies',
//    4 	=> 'tasks',
//    12 	=> 'customers',
//];
//$entity = $entities[$entity_code];
//
//$params = 'id=' . $entity_id;
//$response = $amoApi->get($entity, $params);
//dump($response);
//
//if (array_key_exists("_embedded", $response)) {
//
//    echo "Ваше примечание добавлено";
//} else {
//    echo "ID сущности и её тип не совпадают";
//}

$entity_id = 10286817;
$entity_code = 3;
$field_text = "test tests";

$entities = [
    1 	=> 'contacts',
    2 	=> 'leads',
    3 	=> 'companies',
    4 	=> 'tasks',
    12 	=> 'customers',
];
$entity = $entities[$entity_code];

//$params = "id=" . $entity_id;
$params = "with=custom_fields";
$response = $amoApi->get("account", $params);
dump($response); die;
$custom_fields = $response["_embedded"]['custom_fields'][$entity];
$field_id = -1;
foreach ($custom_fields as $custom_field) {
    if ($custom_field['field_type'] == 1) {
        $field_id = $custom_field['id'];
        break;
    }
}
if ($field_id < 0) {
    echo "У данной сущности нет текстового поля";
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

dump($amoApi->update($entity, [$entity_to_update]));
