<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/api/AmoApi.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/helpers.php');

use Amo\Api\AmoApi;


$n = 2;
$login = 'mfilippov@team.amocrm.com';
$hash = '46dc105cf215a952995d55378d858bedf78fd024';

$amoApi = new AmoApi();
$response = $amoApi->authorization($login, $hash);

$entities = [
    'contacts',
    'companies',
    'leads',
    'customers'
];
$data = [];
//foreach ($entities as $entity) {
//    for ($i = 0; $i < $n; $i++) {
//
//        //entities for adding them to current entity
//        $entities_to_add = $entities;
//        $entities_to_add = array_diff($entities_to_add, [$entity]);
//
//        //if entity isn't company changing 'companies' to 'company' to add company_id
//        if (array_search('companies', $entities_to_add)) {
//            $entities_to_add[array_search('companies', $entities_to_add)] = 'company';
//        }
//
//        //leads and customers isn't connect
//        if ($entity == 'leads') {
//            $entities_to_add = array_diff($entities_to_add, ['customers']);
//        }
//        if ($entity == 'customers') {
//            $entities_to_add = array_diff($entities_to_add, ['leads']);
//        }
//
//        $fields_to_add = [];
//        $fields_to_add['name'] = $entity . $i;
//        foreach ($entities_to_add as $entity_to_add) {
//             $fields_to_add["{$entity_to_add}_id"] = "$entity_to_add" . $i;
//        }
//        $data[$entity]['add'][] = $fields_to_add;
//    }
//}

//foreach ($data as $entity_name => $entity_fields) {
//    dump($entity_name);
//    dump($entity_fields);
//    $amoApi->add($entity_name, $entity_fields);
//}
$entities_data = [];
foreach ($entities as $entity) {
    $entity_data = [];
    for ($i = 0; $i < $n; $i++) {
        $fields_to_add['name'] = $entity . $i;
        //customers require timestamp
        if ($entity == 'customers') {
            $fields_to_add['next_date'] = strtotime('22-09-2019');
        }
        $entity_data['add'][] = $fields_to_add;
    }
    $entities_data[$entity] = $entity_data;
}
dump($entities_data);

$response = $amoApi->add('contacts', $entities_data['contacts']);
$response = $response["_embedded"]['items'];
$contacts_id = [];
foreach ($response as $item) {
    $contacts_id[] = $item['id'];
}
foreach ($entities_data['companies']['add'] as $key => $companie) {
    $companie['contacts_id'] = $contacts_id[$key];
}
dump($entities_data);

