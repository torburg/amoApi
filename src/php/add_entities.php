<?php
include($_SERVER['DOCUMENT_ROOT'] . "header.php");
use \Amo\Api\AmoApi;
//проверка авторизации?..

if ($_POST) {
    if ($_POST['count'] >= 0 && $_POST['count'] <= 10000) {

        $entities = [
            'leads',
            'contacts',
            'companies',
            'customers'
        ];
        foreach ($entities as $entity) {

        }


        $api = new AmoApi();
        $api->add('leads', $data);
    }
}