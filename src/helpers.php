<?php
define('ERRORS', [
    301 => 'Moved permanently',
    400 => 'Bad request',
    401 => 'Unauthorized',
    403 => 'Forbidden',
    404 => 'Not found',
    500 => 'Internal server error',
    502 => 'Bad gateway',
    503 => 'Service unavailable'
]);
define('ENTITIES', [
    1 	=> 'contacts',
    2 	=> 'leads',
    3 	=> 'companies',
    4 	=> 'tasks',
    12 	=> 'customers',
]);
define('COLORS', [
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
]);

define('LIMIT', 250);

function dump($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}

function generate_random_string(int $length = 10) : string {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
