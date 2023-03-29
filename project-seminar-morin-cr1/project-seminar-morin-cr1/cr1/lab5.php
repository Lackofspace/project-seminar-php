<?php
$mysqli = new mysqli('localhost', 'root', 'root', 'prof203');
$charset = $mysqli->get_charset();
echo "charset ". $charset->comment . ' collation '.$charset->collation.PHP_EOL;
printf("Изначальная кодировка: %s\n", $mysqli->character_set_name());
/* изменение набора символов на utf8mb4 */
if (!$mysqli->set_charset("utf8mb4")) {
    printf("Ошибка при загрузке набора символов utf8mb4: %s\n", $mysqli->error);
// exit(); // обработка ошибки
} else {
    printf("Текущий набор символов: %s\n", $mysqli->character_set_name());
}
/* Select запросы возвращают результирующий набор */
if ($result = $mysqli->query("SELECT * FROM Students LIMIT 10")) {
    printf("Select вернул %d строк.\n", $result->num_rows);
    $rows = $result->fetch_all(MYSQLI_ASSOC);
    print_r($rows);
    /* очищаем результирующий набор */
    $result->close();
}
// зададние 4
//$dbh = new PDO('mysql:host=localhost;dbname=new_dat;charset=utf8', 'root', 'root');
//
//$query = "INSERT INTO `students` (`id`, `lastname`, `firstname`, `grid`, `age`) VALUES ('имя', 'фамилия', 'имя', '47', '20')";
//// выполняем запрос
//$res = $dbh->query($query);
//var_dump($res);
//foreach ($res as $row) {
//    printf("%s %s %s" . PHP_EOL, $row[0], $row[1], $row[2], $row[3]);
//}
