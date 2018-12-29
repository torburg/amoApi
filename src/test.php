<?php
include($_SERVER['DOCUMENT_ROOT'] . "/header.php");

use Amo\Api\AmoApi;

$login = 'mfilippov@team.amocrm.com';
$hash = '46dc105cf215a952995d55378d858bedf78fd024';

$amoApi = new AmoApi();
$amoApi->authorization($login, $hash);

$contact177_id = 1823636;


