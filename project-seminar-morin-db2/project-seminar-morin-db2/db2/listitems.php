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
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $query_style = "SELECT * FROM `book` INNER JOIN `style` USING(Style_id) WHERE `Book_name`=?";
    $sth_style = $dbh->prepare( $query_style );
    $book_name = $_GET["Book_name"]; // необходимо так же фильтровать значения
    $sth_style->execute( [$book_name] );
//    if($sth_style !== true) {
//        print_r(json_encode([]));
//        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
//        die();
//    }
    $arr = [];
    foreach ($sth_style as $row) {
        $arr[$book_name.' (style)'] = $row[6];
    }

    //книга -> год издания
    $query_recency = "SELECT * FROM `book` INNER JOIN `recency` USING(Recency_id) WHERE `Book_name`=?";
    $sth_recency = $dbh->prepare( $query_recency );
    $sth_recency->execute( [$book_name] );
//    if($sth_recency !== true) {
//        print_r(json_encode([]));
//        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
//        die();
//    }
    foreach ($sth_recency as $row) {
        $arr[$book_name.' (recency)'] = $row[6];
    }

    //книга -> книга на руках у читателя или в библиотеке
    $query_location = "SELECT * FROM `book` INNER JOIN `location` USING(Location_id) WHERE `Book_name`=?;";
    $sth_location = $dbh->prepare( $query_location );
    $sth_location->execute([$book_name]);
//    if($sth_location !== true) {
//        print_r(json_encode([]));
//        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
//        die();
//    }
    foreach ($sth_location as $row) {
            $arr[$book_name.' (location)'] = $row[6];
    }
    print_r(json_encode($arr));


//    //выполняем запрос для всех книг -> жанр
//    $query_all_book_style = "SELECT * FROM `book` INNER JOIN `style` USING(Style_id);";
//    $res_all_book_style = $dbh->query($query_all_book_style);
////    if($res_all_book_style !== true) {
////        print_r(json_encode([]));
////        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
////        die();
////    }
//    $arrAll = [];
//    foreach ($res_all_book_style as $row) {
//        $arrAll[$row[2].' (style)'] = $row[6];
//    }
//    //print_r(json_encode($arrAll));
//
//    //выполняем запрос для всех книг -> год издания
//    $query_all_book_recency = "SELECT * FROM `book` INNER JOIN `recency` USING(Recency_id);";
//    $res_all_book_recency = $dbh->query($query_all_book_recency);
////    if($res_all_book_recency !== true) {
////        print_r(json_encode([]));
////        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
////        die();
////    }
//    foreach ($res_all_book_recency as $row) {
//        $arrAll[$row[2].' (recency)'] = $row[6];
//    }
//    //print_r(json_encode($arrAll));
//
//    //выполняем запрос для всех книг -> книга на руках у читателя или в библиотеке
//    $query_all_book_location = "SELECT * FROM `book` INNER JOIN `location` USING (Location_id);";
//    $res_all_book_location = $dbh->query($query_all_book_location);
////    if($res_all_book_location !== true) {
////        print_r(json_encode([]));
////        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
////        die();
////    }
//    foreach ($res_all_book_location as $row) {
//            $arrAll[$row[2].' (location)'] = $row[6];
//    }
//    print_r(json_encode($arrAll));

//  освобожение ресурса
    $dbh = null;