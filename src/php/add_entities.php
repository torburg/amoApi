<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");
use \Amo\Api\AmoApi;
//проверка авторизации?..

if ($_GET) {
    if ($_GET['count'] >= 0 && $_GET['count'] <= 10000) {

        $count = $_GET['count'];

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

        do {
            $n = 0;
            //250 - recommended entities amount to add with one request
            if ($count <= 2) {
                $n = $count;
            } else {
                $n = 2;
            }
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

            $count -= $n;
        } while ($count > 0);

    }
}