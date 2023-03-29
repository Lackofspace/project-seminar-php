<?php

try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=bd2;charset=utf8', 'root', 'root');
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print_r(json_encode([]));
    print PHP_EOL."Ошибка подключения к БД";
    die();
}
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        echo 'Error 400 Bad Request.';
    }

    $query_book = "ALTER TABLE `book` ADD `User_id` INT(10) UNSIGNED NULL DEFAULT NULL AFTER `Location_id`;";
    $res_book = $dbh->query($query_book);


    $query_index = "ALTER TABLE `book` ADD INDEX(`User_id`);";
    $res_index = $dbh->query($query_index);

    $query_fk = "ALTER TABLE `book` ADD FOREIGN KEY (`User_id`) 
    REFERENCES `reader`(`User_id`) ON DELETE RESTRICT ON UPDATE RESTRICT;";
    $res_fk = $dbh->query($query_fk);


    $query_inf = "UPDATE `book` SET `User_id` = ? WHERE `book`.`Book_id` = ?;";
    $res_inf = $dbh->prepare($query_inf);
    $data = [$_GET["User_id"], $_GET["Book_id"]]; // необходимо так же фильтровать значения
    $res_inf->execute($data);
    $arr["status"] = "success";
    if( $res_inf === false or $res_book === false or $res_index === false) {
        print_r(json_encode([]));
        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
        die();
    }
    print_r(json_encode($arr));

    //  освобожение ресурса
    $dbh = null;