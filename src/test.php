<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/api/AmoApi.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/helpers.php');

use Amo\Api\AmoApi;


$n = 2;
$login = 'mfilippov@team.amocrm.com';
$hash = '46dc105cf215a952995d55378d858bedf78fd024';

$amoApi = new AmoApi();
$amoApi->authorization($login, $hash);

$entities = [
    'contacts' => [],
    'companies' => [],
    'leads' => [],
    'customers' => []
];
$contacts = $amoApi->collect('contact', $n, $entities);
$response = $amoApi->add('contacts', $contacts);
$response = $response["_embedded"]['items'];
$entities['contacts'] = $amoApi->response_processing($response);

$companies = $amoApi->collect('company', $n, $entities);
$response = $amoApi->add('companies', $companies);
$response = $response["_embedded"]['items'];
$entities['companies'] = $amoApi->response_processing($response);

//customers and leads don't connect -> response_processing doesn't required
$customers = $amoApi->collect('customers', $n, $entities);
$response = $amoApi->add('customers', $customers);

$leads = $amoApi->collect('leads', $n, $entities);
$amoApi->add('leads', $leads);



