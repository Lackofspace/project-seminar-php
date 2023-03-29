<?php
try{
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
    //читатель -> книга на руках у читателя или в библиотеке
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);
    $query_location = "SELECT * FROM `reader` INNER JOIN `location` USING(Location_id) WHERE `Surname`=?;";
    $sth_location = $dbh->prepare( $query_location );
    $surname = $_GET["Surname"]; // необходимо так же фильтровать значения
    $sth_location->execute([$surname]);
//    if($sth_location !== true) {
//        print_r(json_encode([]));
//        echo PHP_EOL."Ошибка запроса к базе: ".PHP_EOL; print_r($dbh->errorInfo());
//        die();
//    }
    $arr_location = [];
    foreach ($sth_location as $row) {
            $arr_location[$surname] = $row[5];
    }
    print_r(json_encode($arr_location));


//    //все читатели -> книга на руках у читателя или в библиотеке
//    $query_all_location = "SELECT * FROM `reader` INNER JOIN `location` USING(Location_id);";
//    $sth_all_location = $dbh->query( $query_all_location );
//    $arr_all_location = [];
//    foreach ($sth_all_location as $row) {
//            $arr_all_location[$row[3]] = $row[5];
//    }
//    print_r(json_encode($arr_all_location));


//  освобожение ресурса
    $dbh = null;
