-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Дек 14 2018 г., 17:21
-- Версия сервера: 5.7.23
-- Версия PHP: 7.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `tosee`
--

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `id` int(10) NOT NULL,
  `customer_id` int(10) DEFAULT NULL,
  `seller_id` int(10) DEFAULT NULL,
  `rate` tinyint(2) DEFAULT NULL,
  `status` enum('INACTIVE','ACTIVE') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `tbl_orders_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `tbl_usr_user` (`id`),
  ADD CONSTRAINT `tbl_orders_ibfk_2` FOREIGN KEY (`seller_id`) REFERENCES `tbl_usr_user` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
