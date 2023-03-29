<?php
try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print_r([]);
    echo PHP_EOL.'Ошибка подключения к БД';
    $er = $e->getMessage();
    $log = date('Y-m-d H:i:s') . ' '.$er;
    file_put_contents('C:/tmp' . '/Log.txt', $log. PHP_EOL, FILE_APPEND);
}


if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(400);
    $log = date('Y-m-d H:i:s') . ' Error 400. Bad Request';
    file_put_contents('C:/tmp' . '/Log.txt', $log. PHP_EOL, FILE_APPEND);
    //echo 'Error 400 Bad Request.';
    die();
}

ini_set('session.save_path', 'C:/tmp');
ini_set('session.use_strict_mode', 1);
session_start();
session_set_cookie_params([
    'lifetime' => $maxlifetime = 3600,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => $secure = true,
    'httponly' => $httponly = true,
    'samesite' => $samesite = 'strict'
]);
header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0', FALSE);
header('Pragma: no-cache');

if( isset($_SESSION['is_auth']) && $_SESSION['is_auth'] ) {
    echo "You are already authenticated! No need to do it again".PHP_EOL;
    return;
}

try {
    $query = "SELECT * FROM `registration` WHERE `login` = ? AND `password` = ?;";
    $sth = $dbh->prepare($query);
    $login = $_POST["login"];
    $password = $_POST["password"];
    $request = [$login, $password];
    $sth->execute($request);
    $ldb = '';
    $pdb = '';
    foreach ($sth as $row) {
        $ldb = $row[1];
        $pdb = $row[2];
    }
    if( $login == $ldb && $password == $pdb ) {
        echo "OK".PHP_EOL;
        $_SESSION['is_auth'] = true;
    }
    else {
        $log = date('Y-m-d H:i:s') . ' Ошибка авторизации!';
        file_put_contents('C:/tmp' . '/SecurityLog.txt', $log. PHP_EOL, FILE_APPEND);
        echo "Invalid credentials".PHP_EOL;
    }
    $dbh = null;
}
catch (PDOException $e){
    print_r([]);
    echo PHP_EOL.'Ошибка запроса к базе';
    $er = $e->getMessage();
    $log = date('Y-m-d H:i:s') . ' '.$er;
    file_put_contents('C:/tmp' . '/Log.txt', $log. PHP_EOL, FILE_APPEND);
}