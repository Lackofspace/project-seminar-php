<?php

try {
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');

    //добавление записи в reader
    $query = "INSERT INTO `reader` (`User_id`, `Name`, `Surname`, `Age`, `Location_id`) 
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
    $User_id = $_GET["User_id"];
    $Name = $_GET["Name"];
    $Surname = $_GET["Surname"];
    $Age = $_GET["Age"];
    $Location_id = $_GET["Location_id"];
    $book = [$User_id, $Name, $Surname, $Age, $Location_id]; // необходимо так же фильтровать значения
    $sth->execute($book);
    $arr["status"] = "success";
    $arr["id"] = $User_id;
    if( $sth === false ) {
        echo "Ошибка запроса:".PHP_EOL; print_r($dbh->errorInfo());
    }
    else {
        print_r(json_encode($arr));
    }
    //  освобожение ресурса
    $dbh = null;
}
catch (PDOException $e) {
    $arr["status"] = "error";
    $arr["message"] = "Failed to add record";
    print_r(json_encode($arr));
    die();
}