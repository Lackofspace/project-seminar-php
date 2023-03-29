-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 10 2021 г., 12:43
-- Версия сервера: 10.6.5-MariaDB
-- Версия PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bd1`
--

-- --------------------------------------------------------

--
-- Структура таблицы `book`
--

CREATE TABLE `book` (
  `Book_id` int(10) UNSIGNED NOT NULL,
  `Book_name` varchar(100) CHARACTER SET utf8mb3 NOT NULL,
  `Style_id` int(10) UNSIGNED DEFAULT NULL,
  `Recency_id` int(10) UNSIGNED DEFAULT NULL,
  `Books on the hands id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `book`
--

INSERT INTO `book` (`Book_id`, `Book_name`, `Style_id`, `Recency_id`, `Books on the hands id`) VALUES
(1, 'Унесенные ветром. Том 1', 5, 2, 1),
(2, 'Граф Монте-Кристо', 2, 3, 1),
(3, 'Граф Монте-Кристо. Том 1', 4, 3, 2),
(4, 'Граф Монте-Кристо. Том 2', 8, 3, 1),
(5, 'Книжный вор', 9, 2, 2),
(6, 'Ключи Царства', 7, 1, 2),
(7, 'Три мушкетера Цикл «Три мушкетера», №1', 8, 5, 2),
(8, 'Королева Марго Цикл «Гугенотские войны», №1', 1, 4, 1),
(9, 'Террор', 1, 4, 2),
(10, 'Одиссея капитана Блада', 10, 6, 2),
(11, 'Всадник без головы', 5, 6, 1),
(12, 'Имя розы', 4, 8, 1),
(13, 'Сёгун Цикл «Азиатская сага», №1', 10, 7, 1),
(14, 'Тобол. Мало избранных Цикл «Тобол», №2', 10, 8, 1),
(15, 'Робинзон Крузо Цикл «Робинзон Крузо», №1', 8, 10, 1),
(16, 'Еще одна из рода Болейн Цикл «Тюдоры», №3', 1, 8, 1),
(17, 'Двадцать лет спустя Цикл «Три мушкетера», №2', 1, 6, 1),
(18, 'Путешествия Гулливера', 2, 8, 2),
(19, 'Франкенштейн, или Современный Прометей', 2, 7, 2),
(20, 'Алиса в стране чудес', 2, 9, 1),
(21, 'Двадцать тысяч лет под водой', 7, 7, 2),
(22, 'Странная история доктора Джекила и мистера Хайда', 7, 8, 2),
(23, 'Янки из Коннектикута при дворе короля Артура', 1, 8, 2),
(24, 'Дракула', 2, 8, 1),
(25, 'Властелин колец', 2, 8, 1),
(26, 'Дюна', 8, 6, 2),
(27, 'Песнь льда и огня', 8, 7, 1),
(28, '1984', 6, 8, 2),
(29, 'Сами боги', 9, 8, 1),
(30, 'Свидание с Рамой', 7, 8, 2),
(31, 'Пикник на обочине', 10, 2, 1),
(32, 'Говорящий от имени мёртвых', 7, 8, 1),
(33, 'Рассказ служанки', 2, 9, 2),
(34, '2001: Космическая одиссея', 6, 9, 2),
(35, 'Мозг материален', 9, 6, 1),
(36, 'Кто бы мог подумать! Как мозг заставляет нас делать глупости', 3, 4, 2),
(37, 'В интернете кто-то неправ! Научные исследования спорных вопросов', 3, 5, 1),
(38, 'Эгоистичный ген', 3, 9, 2),
(39, 'Самое грандиозное шоу на Земле. Доказательства эволюции', 2, 9, 1),
(40, 'Слепой часовщик. Как эволюция доказывает отсутствие замысла во Вселенной\r\n', 8, 9, 2),
(41, 'Как не ошибаться. Сила математического мышления', 3, 8, 1),
(42, 'Почти человек. Как открытие Homo naledi изменило нашу историю', 3, 8, 2),
(43, 'Теория игр. Искусство стратегического мышления в бизнесе и жизни', 3, 1, 2),
(44, 'Удовольствие от X. Увлекательное путешествие в мир математики ...', 10, 7, 2),
(45, 'Преломление. Наука видеть иначе', 3, 10, 1),
(46, 'Кому нужна математика? Понятная книга о том, как устроен цифровой мир', 2, 10, 1),
(47, 'Космос. Эволюция Вселенной, жизни и цивилизации', 3, 9, 2),
(48, 'Большое космическое путешествие', 3, 9, 2),
(49, 'Вселенная Стивена Хокинга', 3, 10, 2),
(50, 'Разум. Что значит быть человеком', 4, 10, 2),
(51, 'Голая статистика. Самая интересная книга о самой скучной науке', 5, 10, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `location`
--

CREATE TABLE `location` (
  `Books on the hands id` int(10) UNSIGNED NOT NULL,
  `location` varchar(20) CHARACTER SET utf8mb3 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `location`
--

INSERT INTO `location` (`Books on the hands id`, `location`) VALUES
(1, 'in the library'),
(2, 'with a reader');

-- --------------------------------------------------------

--
-- Структура таблицы `reader`
--

CREATE TABLE `reader` (
  `User_id` int(10) UNSIGNED NOT NULL,
  `Name` varchar(20) CHARACTER SET utf8mb3 NOT NULL,
  `Surname` varchar(20) CHARACTER SET utf8mb3 NOT NULL,
  `Age` int(10) NOT NULL,
  `Books on the hands id` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `reader`
--

INSERT INTO `reader` (`User_id`, `Name`, `Surname`, `Age`, `Books on the hands id`) VALUES
(1, 'Август', 'Милов', 25, 1),
(2, 'Абрам', 'Вовченков', 17, 2),
(3, 'Александр', 'Иванов', 20, 1),
(4, 'Алексей', 'Смирнов', 19, 2),
(5, 'Альберт', 'Кузнецов', 15, 1),
(6, 'Анатолий', 'Попов', 10, 2),
(7, 'Андрей', 'Васильев', 21, 2),
(8, 'Антон', 'Петров', 23, 2),
(9, 'Борис', 'Соколов', 22, 2),
(10, 'Виктор', 'Михайлов', 18, 2),
(11, 'Семён', 'Новиков', 12, 2),
(12, 'Никита', 'Фёдоров', 14, 1),
(13, 'Виктор', 'Морозов', 22, 1),
(14, 'Виталий', 'Волков', 24, 1),
(15, 'Вячеслав', 'Алексеев', 23, 2),
(16, 'Всеволод', 'Лебедев', 15, 2),
(17, 'Глеб', 'Семёнов', 23, 1),
(18, 'Данил', 'Егоров', 34, 1),
(19, 'Егор', 'Павлов', 17, 2),
(20, 'Ждан', 'Козлов', 20, 2),
(21, 'Захар', 'Степанов', 43, 1),
(22, 'Ибрагим', 'Николаев', 32, 2),
(23, 'Игорь', 'Орлов', 13, 2),
(24, 'Илья', 'Андреев', 24, 1),
(25, 'Иосиф', 'Макаров', 21, 1),
(26, 'Исай', 'Никитин', 31, 2),
(27, 'Карл', 'Захаров', 24, 1),
(28, 'Ким', 'Зайцев', 50, 1),
(29, 'Константин', 'Соловьёв', 23, 1),
(30, 'Кузьма', 'Борисов', 33, 1),
(31, 'Лев', 'Яковлев', 21, 2),
(32, 'Леонид', 'Сергеев', 32, 2),
(33, 'Макар', 'Григорьевич', 32, 1),
(34, 'Максим', 'Романов', 14, 1),
(35, 'Марат', 'Воробьёв', 31, 1),
(36, 'Марк', 'Кузьмин', 19, 1),
(37, 'Матвей', 'Фролов', 24, 1),
(38, 'Назар', 'Александров', 41, 1),
(39, 'Николай', 'Дмитриев', 21, 2),
(40, 'Олег', 'Королёв', 32, 2),
(41, 'Осип', 'Гусев', 32, 2),
(42, 'Аскар', 'Киселёв', 21, 1),
(43, 'Павел', 'Ильин', 20, 2),
(44, 'Пётр', 'Максимов', 11, 1),
(45, 'Платон', 'Поляков', 26, 2),
(46, 'Прохор', 'Сорокин', 29, 2),
(47, 'Рафаил', 'Виноградов', 23, 1),
(48, 'Роберт', 'Ковалев', 18, 2),
(49, 'Роман', 'Белов', 36, 2),
(50, 'Степан', 'Медведев', 40, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `recency`
--

CREATE TABLE `recency` (
  `Recency_id` int(10) UNSIGNED NOT NULL,
  `time` varchar(1000) CHARACTER SET utf8mb3 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `recency`
--

INSERT INTO `recency` (`Recency_id`, `time`) VALUES
(1, '1740-1770 years'),
(2, '1770-1800 years'),
(3, '1800-1830 years'),
(4, '1830-1860 years'),
(5, '1860-1890 years'),
(6, '1890-1910 years'),
(7, '1910-1940 years'),
(8, '1940-1970 years'),
(9, '1970-2000 years'),
(10, '2000- nowadays');

-- --------------------------------------------------------

--
-- Структура таблицы `style`
--

CREATE TABLE `style` (
  `Style_id` int(10) UNSIGNED NOT NULL,
  `Style` varchar(1000) CHARACTER SET utf8mb3 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп данных таблицы `style`
--

INSERT INTO `style` (`Style_id`, `Style`) VALUES
(1, 'history'),
(2, 'fiction'),
(3, 'science'),
(4, 'adventure'),
(5, 'affair'),
(6, 'art'),
(7, 'detective story'),
(8, 'classical'),
(9, 'business'),
(10, 'unknown');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Book_id`),
  ADD KEY `Style_id` (`Style_id`),
  ADD KEY `Recency_id` (`Recency_id`),
  ADD KEY `Books on the hands id` (`Books on the hands id`);

--
-- Индексы таблицы `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`Books on the hands id`);

--
-- Индексы таблицы `reader`
--
ALTER TABLE `reader`
  ADD PRIMARY KEY (`User_id`),
  ADD KEY `Books on the hands` (`Books on the hands id`);

--
-- Индексы таблицы `recency`
--
ALTER TABLE `recency`
  ADD PRIMARY KEY (`Recency_id`);

--
-- Индексы таблицы `style`
--
ALTER TABLE `style`
  ADD PRIMARY KEY (`Style_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `book`
--
ALTER TABLE `book`
  MODIFY `Book_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `location`
--
ALTER TABLE `location`
  MODIFY `Books on the hands id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `reader`
--
ALTER TABLE `reader`
  MODIFY `User_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT для таблицы `recency`
--
ALTER TABLE `recency`
  MODIFY `Recency_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `style`
--
ALTER TABLE `style`
  MODIFY `Style_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `book`
--
ALTER TABLE `book`
  ADD CONSTRAINT `book_ibfk_1` FOREIGN KEY (`Recency_id`) REFERENCES `recency` (`Recency_id`),
  ADD CONSTRAINT `book_ibfk_2` FOREIGN KEY (`Style_id`) REFERENCES `style` (`Style_id`),
  ADD CONSTRAINT `book_ibfk_3` FOREIGN KEY (`Books on the hands id`) REFERENCES `location` (`Books on the hands id`);

--
-- Ограничения внешнего ключа таблицы `reader`
--
ALTER TABLE `reader`
  ADD CONSTRAINT `reader_ibfk_1` FOREIGN KEY (`Books on the hands id`) REFERENCES `location` (`Books on the hands id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
