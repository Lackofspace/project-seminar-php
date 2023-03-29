<?php

try{
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    $arr["status"] = "error";
    $arr["message"] = "Failed to delete record";
    print_r(json_encode($arr));
    die();
}

    if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') {
        $arr["status"] = "error";
        $arr["message"] = "Failed to delete record";
        print_r(json_encode($arr));
        die();
    }

    $query = "DELETE FROM `reader` WHERE `reader`.`User_id` = ?;";
    $sth = $dbh->prepare($query);
    $book_id = $_GET["User_id"]; // необходимо так же фильтровать значения
    $sth->execute( [$book_id] );

    $arr = [];
    $arr["status"] = "success";
    print_r(json_encode($arr));

//    if( $sth === true ) {
//        print_r(json_encode($arr));
//    }


    //  освобожение ресурса
    $dbh = null;
