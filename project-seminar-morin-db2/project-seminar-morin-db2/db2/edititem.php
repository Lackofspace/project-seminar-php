<?php

try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');

    //книга -> жанр
    // используются безымянные placeholders - ?
    $query = "UPDATE `book` SET 
                  `Book_id` = ?, `Book_name` = ?, `Style_id` = ?, 
                  `Recency_id` = ?, `Location_id` = ?, `User_id` = ? 
                            WHERE `book`.`Book_id` = ?;";
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $arr["status"] = "error";
        $arr["message"] = "Failed to edit record";
        print_r(json_encode($arr));
        die();
    }
    // подготовка запроса
    $sth = $dbh->prepare($query);
    // выполнение запроса
    $Book_id = $_GET["Book_id"];
    $Book_name = $_GET["Book_name"];
    $Style_id = $_GET["Style_id"];
    $Recency_id = $_GET["Recency_id"];
    $Location_id = $_GET["Location_id"];
    $User_id = $_GET["User_id"];
    $remain_book_id = $_GET["book_id"];
    $book = [$Book_id, $Book_name, $Style_id, $Recency_id, $Location_id, $User_id, $remain_book_id]; // необходимо так же фильтровать значения
    $sth->execute($book);

    $arr["status"] = "success";
    $arr["id"] = $Book_id;
//    if( $sth === true ) {
//        print_r(json_encode($arr));
//    }
    print_r(json_encode($arr));

    //  освобожение ресурса
    $dbh = null;
}
catch (PDOException $e) {
    $arr["status"] = "error";
    $arr["message"] = "Failed to edit record";
    print_r(json_encode($arr));
    die();
}