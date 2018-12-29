<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '4f2e1172393444687df0487b3d5c10286f8e00ee';

$amoApi = new AmoApi();
//dump($amoApi->authorization($login, $hash));

$contact177_id = 1823636;

$login = "";
$password = "";

$amoApi->authorization($login, $password);