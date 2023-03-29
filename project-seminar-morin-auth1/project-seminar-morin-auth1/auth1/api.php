<?php

ini_set('session.save_path', 'C:/tmp');
ini_set('session.use_strict_mode', 1);

session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    http_response_code(400);
    $log = date('Y-m-d H:i:s') . ' Error 400. Bad Request';
    file_put_contents('C:/tmp' . '/Log.txt', $log. PHP_EOL, FILE_APPEND);
    die();
}

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
    echo "OK";
    try {
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
    try {
        $query = "SELECT * FROM `reader` WHERE Name = ? AND Surname = ?;";
        $sth = $dbh->prepare($query);
        $name = $_GET["Name"];
        $surname = $_GET["Surname"];
        $request = [$name, $surname];
        $sth->execute($request);
        $arr = [];
        foreach ($sth as $row) {
            $arr['User_id'] = $row[0];
            $arr['Name'] = $row[1];
            $arr['Surname'] = $row[2];
            $arr['Age'] = $row[3];
            $arr['Location_id'] = $row[4];
        }
        $bdh = null;
    }
    catch (PDOException $e){
        print_r([]);
        echo PHP_EOL.'Ошибка запроса к базе';
        $er = $e->getMessage();
        $log = date('Y-m-d H:i:s') . ' '.$er;
        file_put_contents('C:/tmp' . '/Log.txt', $log. PHP_EOL, FILE_APPEND);
    }
}
else{
    header('HTTP/1.0 403 Forbidden');
    echo "Forbidden";
}