<?php
try {
// создание подключения через connection_string с указанием типа базы
    $dbh = new PDO('mysql:host=localhost;dbname=db2;charset=utf8', 'root', 'root');
// установим режим обработки ошибок
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

// заполнение БД тестовыми данными
    $baseName = 'Пётр';
    $baseSurname = 'Нилов';

    $queryl = "SELECT `Location_id` FROM `location`";
    if (!($result = $dbh->query($queryl))) {
        echo "Ошибка: Группы не заданы" . PHP_EOL;
        exit();
    }
    $groupsL = $result->fetchAll();

    mt_srand();

    /* подготавливаем запрос на вставку строк */
    $query = "INSERT INTO `reader` (`User_id`, `Name`, `Surname`, `Age`, `Location_id`) 
        VALUES (:user_id, :name,:surname,:age,:location_id);";
    $sth = $dbh->prepare($query);
    // привязка переменных
    // первым аргументом является имя placeholder’а
    $sth->bindParam(':user_id', $userid);
    $sth->bindParam(':name', $name);
    $sth->bindParam(':surname', $surname);
    $sth->bindParam(':age', $age);
    $sth->bindParam(':location_id', $locationid);

    for ($i = 1; $i <= 555; $i++) {
        $LKey = rand(1, count($groupsL) - 1);
        $userid = $i;
        $name = $baseName . $i;
        $surname = $baseSurname . $i;
        $age = rand(15, 90);
        $locationid = $groupsL[$LKey]['Location_id'];
        /* выполняем запрос */
        $sth->execute();
        echo "Запись " . $name . " добавлена" . PHP_EOL;
    }

    // освобожение ресурса
    $dbh = null;
    $sth = null;
} catch (PDOException $e) {
    echo "Error!: " . $e->getMessage() . PHP_EOL;
//    print_r($e); // можно записать подробную информацию об ошибке в лог файл
    $dbh = null;
}