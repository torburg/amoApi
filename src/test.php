<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/api/AmoApi.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/src/helpers.php');

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '46dc105cf215a952995d55378d858bedf78fd024';

$amoApi = new AmoApi();
$amoApi->authorization($login, $hash);

$contacts = $amoApi->collect('contact', 1);

//dump($old_fields);
$entities = [
    'contacts' => [],
    'companies' => [],
    'leads' => [],
    'customers' => []
];

$fields = $amoApi->collect('fields', 1);
$request = $amoApi->add('fields', $fields);
//dump($request);

//$field_id = $request['_embedded']['items'][0]['id'];

$colors = [
    "чёрный",
    "белый",
    "красный",
    "оранжевый",
    "голубой",
    "фиолетовый",
    "прозрачный",
    "жёлтый",
    "синий",
    "зелёный"
];
dump($response = $amoApi->get('contacts'));
$response = $response['_embedded']['items'];
$field_id = 90329;

$contacts  = [];
foreach ($response as $item) {
    $contact = [];
    $contact['id'] = $item['id'];
    $contact['updated_at'] = time();
    $contact['custom_fields'] = [
        [
            'id' => $field_id,
            'name' => 'field_name',
            'values' => [
                $colors[array_rand($colors)],
                $colors[array_rand($colors)]
            ]
        ]
    ];
    $contacts[] = $contact;
}

dump($contacts);
$response = $amoApi->update('contacts', $contacts);
dump($response);