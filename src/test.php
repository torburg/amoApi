<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;


$login = 'mfilippov@team.amocrm.com';
$hash = '2e39d1a98868c0f5dba770757150480a1c936685';
$amoApi = new AmoApi();
$amoApi->authorization($login, $hash);
$fields = $amoApi->collect('fields', 1);
$response = $amoApi->add('fields', $fields);
$field_id = $amoApi->response_processing($response)[0];
dump($field_id);