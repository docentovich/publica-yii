-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Дек 24 2018 г., 15:55
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
-- Структура таблицы `tbl_probank_portfolio`
--

CREATE TABLE `tbl_probank_portfolio` (
  `id` int(10) NOT NULL,
  `about` text CHARACTER SET utf8 COLLATE utf8_bin,
  `price` float DEFAULT NULL,
  `main_photo` int(10) DEFAULT NULL,
  `user_id` int(10) DEFAULT NULL,
  `type` enum('MODEL','PHOTOGRAPHER') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'MODEL',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Структура таблицы `tbl_probank_portfolio_additional_images`
--

CREATE TABLE `tbl_probank_portfolio_additional_images` (
  `image_id` int(10) NOT NULL,
  `portfolio_id` int(10) NOT NULL,
  `type` enum('PORTFOLIO','SNAP') CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT 'PORTFOLIO'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `tbl_probank_portfolio`
--
ALTER TABLE `tbl_probank_portfolio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`),
  ADD KEY `main_photo` (`main_photo`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `tbl_probank_portfolio_additional_images`
--
ALTER TABLE `tbl_probank_portfolio_additional_images`
  ADD PRIMARY KEY (`image_id`,`portfolio_id`),
  ADD KEY `image_id` (`image_id`),
  ADD KEY `portfolio_id` (`portfolio_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `tbl_probank_portfolio`
--
ALTER TABLE `tbl_probank_portfolio`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `tbl_probank_portfolio`
--
ALTER TABLE `tbl_probank_portfolio`
  ADD CONSTRAINT `tbl_probank_portfolio_ibfk_1` FOREIGN KEY (`main_photo`) REFERENCES `tbl_image` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_probank_portfolio_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `tbl_usr_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tbl_probank_portfolio_additional_images`
--
ALTER TABLE `tbl_probank_portfolio_additional_images`
  ADD CONSTRAINT `tbl_probank_portfolio_additional_images_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `tbl_image` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_probank_portfolio_additional_images_ibfk_2` FOREIGN KEY (`portfolio_id`) REFERENCES `tbl_probank_portfolio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
