<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    $log = date('Y-m-d H:i:s') . ' Error 400. Bad Request';
    file_put_contents('C:/tmp' . '/Log.txt', $log. PHP_EOL, FILE_APPEND);
    die();
}

ini_set('session.save_path', 'C:/tmp');
session_start();
$_SESSION['is_auth'] = true;
session_destroy();
if (session_id() == ""){
    echo "OK";
}