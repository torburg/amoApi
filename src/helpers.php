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

function dump($data) {
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
