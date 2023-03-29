<?php
try {
    // создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', 'root', 'root');
    // установим режим обработки ошибок
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // заполнение БД тестовыми данными
    $baseRecency = 'year';


    /* подготавливаем запрос на вставку строк */
    $query = "INSERT INTO `recency` (`Recency_id`, `time`) 
        VALUES (:recency_id, :time);";
    $sth = $dbh->prepare($query);
    // привязка переменных
    // первым аргументом является имя placeholder’а
    $sth->bindParam(':recency_id', $recencyid);
    $sth->bindParam(':time', $time);

    for ($i = 1; $i <= 25; $i++) {
        $recencyid = $i;
        $time = $baseRecency . $i;
        /* выполняем запрос */
        $sth->execute();
        echo "Запись " . $time . " добавлена" . PHP_EOL;
    }

    // освобожение ресурса
    $dbh = null;
    $sth = null;
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . PHP_EOL;
//    print_r($e); // можно записать подробную информацию об ошибке в лог файл
    $dbh = null;
}