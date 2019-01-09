<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '2e39d1a98868c0f5dba770757150480a1c936685';
//
$amoApi = new AmoApi();
dump($amoApi->authorization($login, $hash));

    $fields = $amoApi->collect('fields', 1);
    $request = $amoApi->add('fields', $fields);
    $field_id = $request['_embedded']['items'][0]['id'];

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
#@TODo need to get all contacts (1 request return max 500 contacts)
    $response = $amoApi->get('contacts');
    $response = $response['_embedded']['items'];
    $contacts = [];
    foreach ($response as $item) {
        $contact = [];
        $contact['id'] = $item['id'];
        $contact['updated_at'] = time();
        $contact['custom_fields'] = [
            [
                'id' => $field_id,
                'values' => [
                    $colors[array_rand($colors)],
                    $colors[array_rand($colors)]
                ]
            ]
        ];
        $contacts[] = $contact;
    }
    $response = $amoApi->update('contacts', $contacts);