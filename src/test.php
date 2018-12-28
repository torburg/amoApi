<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '46dc105cf215a952995d55378d858bedf78fd024';

$amoApi = new AmoApi();
$amoApi->authorization($login, $hash);

$contacts = $amoApi->collect('contact', 1);

//dump($amoApi->get('contacts')); die;

//dump($old_fields);
//$entities = [
//    'contacts' => [],
//    'companies' => [],
//    'leads' => [],
//    'customers' => []
//];
//
$entity_id = 1823663;
$entity_code = 1;
$note_type = 4;
$note_text = 'text in note';

$note = [
    [
        'element_id' => $entity_id,
        'element_type' => $entity_code,
        'note_type' => $note_type,
        'text' => $note_text
    ]
];
//$params = ;
$entities = [
    1 	=> 'contacts',
    2 	=> 'leads',
    3 	=> 'companies',
    4 	=> 'tasks',
    12 	=> 'customers',
];
$entity = $entities[$entity_code];
$params = 'id=' . $entity_id;
$amoApi->get($entity, $params);
dump($amoApi->add('notes', $note));



