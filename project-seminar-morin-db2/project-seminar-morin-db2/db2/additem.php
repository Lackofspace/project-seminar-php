<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');
    //добавление записи в book
    $query = "INSERT INTO `book` (`Book_id`, `Book_name`, `Style_id`, `Recency_id`, `Location_id`) 
                VALUES (?, ?, ?, ?, ?);";
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $arr["status"] = "error";
        $arr["message"] = "Failed to add record";
        print_r(json_encode($arr));
        die();
    }
    // подготовка запроса
    $sth = $dbh->prepare( $query );
    // выполнение запроса
    $Book_id = $_GET["Book_id"];
    $Book_name = $_GET["Book_name"];
    $Style_id = $_GET["Style_id"];
    $Recency_id = $_GET["Recency_id"];
    $Location_id = $_GET["Location_id"];
    $book = [$Book_id, $Book_name, $Style_id, $Recency_id, $Location_id]; // необходимо так же фильтровать значения
    $sth->execute($book);
    $arr["status"] = "success";
    $arr["id"] = $Book_id;
    //если добавилась запись
//    if( $sth === true ) {
//        print_r(json_encode($arr));
//    }
    print_r(json_encode($arr));
    //  освобожение ресурса
    $dbh = null;
}
catch (PDOException $e) {
    $arr["status"] = "error";
    $arr["message"] = "Failed to add record";
    print_r(json_encode($arr));
    die();
}