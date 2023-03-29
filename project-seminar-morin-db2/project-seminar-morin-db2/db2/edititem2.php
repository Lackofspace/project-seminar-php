<?php

try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');

    //книга -> жанр
    // используются безымянные placeholders - ?
    $query = "UPDATE `reader` SET 
                  `User_id` = ?, `Name` = ?, `Surname` = ?, 
                  `Age` = ?, `Location_id` = ?
                            WHERE `reader`.`User_id` = ?;";
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        $arr["status"] = "error";
        $arr["message"] = "Failed to edit record";
        print_r(json_encode($arr));
        die();
    }
    // подготовка запроса
    $sth = $dbh->prepare($query);
    // выполнение запроса
    $User_id = $_GET["User_id"];
    $Name = $_GET["Name"];
    $Surname = $_GET["Surname"];
    $Age = $_GET["Age"];
    $Location_id = $_GET["Location_id"];
    $remain_user_id = $_GET["user_id"];
    $book = [$User_id, $Name, $Surname, $Age, $Location_id, $remain_user_id]; // необходимо так же фильтровать значения
    $sth->execute($book);

    $arr["status"] = "success";
    $arr["id"] = $User_id;
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
//    echo $e->getMessage();
    print_r(json_encode($arr));
    die();
}