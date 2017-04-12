-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 12 2017 г., 10:01
-- Версия сервера: 5.7.16
-- Версия PHP: 5.6.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `last_task`
--

-- --------------------------------------------------------

--
-- Структура таблицы `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `year_production` year(4) NOT NULL,
  `image_path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `books`
--

INSERT INTO `books` (`id`, `name`, `description`, `year_production`, `image_path`) VALUES
(1, '	 Безбарвний Цкуру Тадзакі та роки його прощі', 'Вони були натхненні та яскраві, що відбивалося навіть у їхніх іменах. Розумник Червоний, який надихав усіх на перемогу. Синій — капітан команди з регбі, що вчив не перейматися поразками. Сором’язлива піаністка Біла — красуня з обличчям японської ляльки. Чорна — іронічна комедіантка-інтелектуалка. І невиразної барви Цкуру. П’ятеро шкільних друзів — мов п’ять пальців однієї руки. Серед них головний герой почувався щасливим. Адже він мав мрію. Та одного дня без пояснення причин друзі викреслили Цкуру зі свого життя…', 2000, '/public/image/b06ot2hnf.jpg'),
(2, 'Замкнене коло', 'Покидаючи назавжди дитячий будинок, де вона опинилася після смерті бабусі, Мирослава хотіла назавжди залишити у минулому свої біди. Та нікому було її навчити, що щастя не сплануєш і не заробиш', 2005, '/public/image/qcgaqfe5v.jpeg');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `parent_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`comment_id`, `book_id`, `user_id`, `comment`, `created_at`, `parent_id`) VALUES
(1, 1, 1, 'Нормальна книжка?', '2017-04-12 09:42:53', 0),
(2, 1, 1, 'мабудь так і є', '2017-04-12 09:43:00', 1),
(5, 1, 2, 'Класна книжка ', '2017-04-12 09:59:02', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `comment_marks`
--

CREATE TABLE `comment_marks` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `mark` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `comment_marks`
--

INSERT INTO `comment_marks` (`id`, `comment_id`, `user_id`, `mark`) VALUES
(1, 2, 2, 5),
(2, 1, 2, 4),
(4, 5, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL DEFAULT '/public/image/img.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `img`) VALUES
(1, 'vasya', 'vasyamindresku@mail.ru', '$2y$10$s6WdD.E2WkLPbYxJf9aF5uAXtWybBbWiZuFv3lVqLWYAMHnMMrB0W', '/public/image/09ceooqhs.jpeg'),
(2, 'Дмитро', 'dima@mail.ru', '$2y$10$vsRk.txWF7HMHPBwu0hZruADebRZW/rprGqtlk/gsFvj4GU5liqYS', '/public/image/mbzitwk4j.jpeg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `book_id` (`book_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `comment_marks`
--
ALTER TABLE `comment_marks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT для таблицы `comment_marks`
--
ALTER TABLE `comment_marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ограничения внешнего ключа таблицы `comment_marks`
--
ALTER TABLE `comment_marks`
  ADD CONSTRAINT `comment_marks_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`comment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_marks_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
