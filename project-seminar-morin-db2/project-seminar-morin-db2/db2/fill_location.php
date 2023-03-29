<?php
try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', 'root', 'root');
    // установим режим обработки ошибок
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // заполнение БД тестовыми данными
    $baseLocation = 'place';


    /* подготавливаем запрос на вставку строк */
    $query = "INSERT INTO `location` (`Location_id`, `Location`) 
        VALUES (:location_id, :location);";
    $sth = $dbh->prepare($query);
    // привязка переменных
    // первым аргументом является имя placeholder’а
    $sth->bindParam(':location_id', $locationid);
    $sth->bindParam(':location', $location);

    for ($i = 1; $i <= 25; $i++) {
        $locationid = $i;
        $location = $baseLocation . $i;
        /* выполняем запрос */
        $sth->execute();
        echo "Запись " . $location . " добавлена" . PHP_EOL;
    }

    // освобожение ресурса
    $dbh = null;
    $sth = null;
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . PHP_EOL;
//    print_r($e); // можно записать подробную информацию об ошибке в лог файл
    $dbh = null;
}