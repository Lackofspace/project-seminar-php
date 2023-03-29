<?php

try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print_r(json_encode([]));
    echo PHP_EOL."Ошибка подключения к БД: ". $e->getMessage() . PHP_EOL;
    //print_r($e); // можно записать подробную информацию об ошибке в лог файл
    $dbh = null;
    die();
}
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo 'Error 400 Bad Request.';
    die();
}
    //id книги -> её свойства
    $query_book = "SELECT b.`Book_id`, b.`Book_name`, rec.`time`, s.`Style`, l.`Location`, l.`Location_id`
    FROM `book` b 
    LEFT JOIN `location` l ON b.`Location_id`=l.`Location_id` 
    LEFT JOIN `style` s ON b.`Style_id`=s.`Style_id` 
    LEFT JOIN `recency` rec ON b.`Recency_id`=rec.`Recency_id` WHERE `Book_id`=?";
    $sth_book = $dbh->prepare($query_book);
    $book_id = $_GET["Book_id"]; // необходимо так же фильтровать значения
    $sth_book->execute( [$book_id] );
//    if($sth_book !== true) {
//        print_r(json_encode([]));
//        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
//        die();
//    }
    $arr_book = [];
    $location_var = "";
    foreach ($sth_book as $row) {
        $arr_book["Book_id"] = $row[0];
        $arr_book["Book_name"] = $row[1];
        $arr_book["time"] = $row[2];
        $arr_book["Style"] = $row[3];
        $arr_book["Location"] = $row[4];
        $location_var = $row[5];
    }
    $query = "SELECT * FROM `reader` WHERE `Location_id`=$location_var;";
    $res = $dbh->query($query);
//    if($res !== true) {
//        print_r(json_encode([]));
//        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
//        die();
//    }
    $a = [];
    $count = 0;
    foreach ($res as $row) {
        $count += 1;
        $a[$count]["id"] = $row[0];
        $a[$count]["Surname"] = $row[2];
        $a[$count]["Name"] = $row[1];
    }
    $arr_book["linkedRecords"] = $a;
    print_r(json_encode($arr_book));

    //  освобожение ресурса
    $dbh = null;