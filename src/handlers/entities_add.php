<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");
use \Amo\Api\AmoApi;
//проверка авторизации?..

if ($_POST['count'] >= 0 && $_POST['count'] <= 10000) {

    $to_add = $_POST['count'];

    $login = 'mfilippov@team.amocrm.com';
    $hash = '2e39d1a98868c0f5dba770757150480a1c936685';
    $amoApi = new AmoApi();
    $amoApi->authorization($login, $hash);

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

    $entities = [
        'contacts' => [],
        'companies' => [],
        'leads' => [],
        'customers' => []
    ];

    $i = 0;
    while ($i < $to_add) {
        //250 - recommended entities amount to add with one request
        $adding_quantity = 0;
        if ($to_add - $i >= LIMIT) {
            $adding_quantity = LIMIT;
        } else {
            $adding_quantity = $to_add - $i;
        }

        $contacts = $amoApi->collect('contact', $adding_quantity, $entities);
        $response = $amoApi->add('contacts', $contacts);
        $response = $response["_embedded"]['items'];
        $entities['contacts'] = $amoApi->response_processing($response);

        $companies = $amoApi->collect('company', $adding_quantity, $entities);
        $response = $amoApi->add('companies', $companies);
        $response = $response["_embedded"]['items'];
        $entities['companies'] = $amoApi->response_processing($response);

        //customers and leads don't connect -> response_processing doesn't required
        $customers = $amoApi->collect('customers', $adding_quantity, $entities);
        $response = $amoApi->add('customers', $customers);

        $leads = $amoApi->collect('leads', $adding_quantity, $entities);
        $amoApi->add('leads', $leads);
        $i += $adding_quantity;
    };

    $fields = $amoApi->collect('fields', 1);
    $request = $amoApi->add('fields', $fields);
    $field_id = $request['_embedded']['items'][0]['id'];

    //get all contacts and update them
    $offset = 0;
    $params = "limit_rows=" . LIMIT . "&limit_offset=" . $offset;

    $contacts = [];
    while (TRUE) {
        $get_response = [];
        $get_response = $amoApi->get('contacts', $params);
        if (array_key_exists("_embedded", $get_response)) {
            $get_response = $get_response["_embedded"]["items"];

            foreach ($get_response as $item) {
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
            $offset += LIMIT;
            $params = "limit_rows=" . LIMIT . "&limit_offset=" . $offset;
        } else {
            break;
        }
    }
    $contacts_to_update = array_chunk($contacts, $rows);
    foreach ($contacts_to_update as $contacts) {
        $amoApi->update('contacts', $contacts);
    }
}

