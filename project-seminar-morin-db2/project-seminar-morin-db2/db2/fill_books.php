<?php

try {
// создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', 'root', 'root');
// установим режим обработки ошибок
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// заполнение БД тестовыми данными
    $baseBookName = 'Book';

    $queryl = "SELECT `Location_id` FROM `location`";
    if (!($result = $dbh->query($queryl))) {
        echo "Ошибка: Группы не заданы" . PHP_EOL;
        exit();
    }
    $groupsL = $result->fetchAll();

    $queryr = "SELECT `Recency_id` FROM `recency`";
    if (!($result = $dbh->query($queryr))) {
        echo "Ошибка: Группы не заданы" . PHP_EOL;
        exit();
    }
    $groupsR = $result->fetchAll();

    $querys = "SELECT `Style_id` FROM `style`";
    if (!($result = $dbh->query($querys))) {
        echo "Ошибка: Группы не заданы" . PHP_EOL;
        exit();
    }
    $groupsS = $result->fetchAll();

    mt_srand();

    /* подготавливаем запрос на вставку строк */
    $query = "INSERT INTO `book` (`Book_id`, `Book_name`, `Style_id`, `Recency_id`, `Location_id`) 
        VALUES (:book_id, :book_name,:style_id,:recency_id,:location_id);";
    $sth = $dbh->prepare($query);
    // привязка переменных
    // первым аргументом является имя placeholder’а
    $sth->bindParam(':book_id', $bookid);
    $sth->bindParam(':book_name', $bookname);
    $sth->bindParam(':style_id', $styleid);
    $sth->bindParam(':recency_id', $recencyid);
    $sth->bindParam(':location_id', $locationid);

    for ($i = 1; $i <= 555; $i++) {
        $LKey = rand(1, count($groupsL) - 1);
        $RKey = rand(1, count($groupsR) - 1);
        $SKey = rand(1, count($groupsS) - 1);
        $bookid = $i;
        $bookname = $baseBookName . $i;
        $styleid = $groupsS[$SKey]['Style_id'];
        $recencyid = $groupsR[$RKey]['Recency_id'];
        $locationid = $groupsL[$LKey]['Location_id'];
        /* выполняем запрос */
        $sth->execute();
        echo "Запись " . $bookname . " добавлена" . PHP_EOL;
    }

    // освобожение ресурса
    $dbh = null;
    $sth = null;
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . PHP_EOL;
//    print_r($e); // можно записать подробную информацию об ошибке в лог файл
    $dbh = null;
}