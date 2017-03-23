-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Час створення: Бер 22 2017 р., 19:56
-- Версія сервера: 10.1.19-MariaDB
-- Версія PHP: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `userdatabase`
--

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` tinyint(3) NOT NULL,
  `login` varchar(20) CHARACTER SET utf8 NOT NULL,
  `userName` varchar(20) CHARACTER SET utf8 NOT NULL,
  `Email` varchar(20) CHARACTER SET utf8 NOT NULL,
  `textArea` text CHARACTER SET utf8 NOT NULL,
  `ip` varchar(30) CHARACTER SET utf8 NOT NULL,
  `filePath` varchar(50) CHARACTER SET utf8 NOT NULL,
  `dateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `login`, `userName`, `Email`, `textArea`, `ip`, `filePath`, `dateTime`) VALUES
(17, 'Andrones', 'Андрей', 'andrones84@mail.ru', 'Увлекаюсь серверным веб программировванием.', '127.0.0.1', 'upload/21-03-2017-21-33-29.jpg', '2017-03-08 22:33:29'),
(18, 'Zerro', 'Мартин', 'mart_sh@ukr.net', 'Гуру РНР , свою  первую  программу написал  ещё в школе.', '127.0.0.1', 'upload/21-03-2017-21-38-07.jpg', '2017-03-08 22:38:07'),
(19, 'Anastashia', 'Настя', 'nastya80@mail.ru', 'Уверенный пользователь ПК , владею  мастерством Ctrl+C Ctrl+V Ctrl+A', '127.0.0.1', 'upload/21-03-2017-21-42-40.jpg', '2017-03-12 22:42:40'),
(20, 'Levan', 'Сергей', 'serg_levan84@gmail.c', 'Недавно  купил комп.  Хочу найти  хорошие курсы  по  информатике', '127.0.0.1', '', '2017-03-14 22:45:36'),
(21, 'Inna91', 'Инна', 'inna91@list.ru', 'Я web-дизайнер, ищу людей для своей команды', '127.0.0.1', 'upload/21-03-2017-21-48-04.jpg', '2017-03-14 22:48:04'),
(22, 'Alex', 'Алексей', 'alex77@gmail.com', 'Программист  с большим  стажем , провожу частніе уроки  по  PHP JS HTML CSS', '127.0.0.1', '', '2017-03-17 22:55:16'),
(23, 'NaTaLi', 'Наталья', 'natali85@ukr.net', 'Всем Привет. Я WEB-дизайнер, работаю с различными графическими редакторами. Кому нужна помощь, обращайтесь', '127.0.0.1', '', '2017-03-21 23:01:36');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
