-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Апр 17 2019 г., 10:41
-- Версия сервера: 10.3.13-MariaDB-1:10.3.13+maria~bionic
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `pw`
--

-- --------------------------------------------------------

--
-- Структура таблицы `boxs`
--

CREATE TABLE `boxs` (
  `id` int(11) NOT NULL,
  `num_box` varchar(7) NOT NULL,
  `sum_roz` int(11) DEFAULT NULL,
  `lat` varchar(20) DEFAULT NULL,
  `lon` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `boxs`
--

INSERT INTO `boxs` (`id`, `num_box`, `sum_roz`, `lat`, `lon`) VALUES
(0, '0', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `olts`
--

CREATE TABLE `olts` (
  `id` int(11) NOT NULL,
  `ip` int(10) UNSIGNED NOT NULL,
  `name` varchar(150) NOT NULL,
  `location` varchar(150) DEFAULT NULL,
  `vendor` varchar(50) NOT NULL,
  `snmppas` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Структура таблицы `onu`
--

CREATE TABLE `onu` (
  `id` int(11) NOT NULL,
  `id_olt` int(11) NOT NULL,
  `uidonu` int(11) NOT NULL,
  `iface` varchar(50) NOT NULL,
  `mac` varchar(50) NOT NULL,
  `boxid` int(11) NOT NULL DEFAULT 0,
  `roz` int(11) DEFAULT NULL,
  `last_laser_lvl` varchar(10) NOT NULL DEFAULT '0',
  `lat` varchar(20) DEFAULT NULL,
  `lon` varchar(20) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=COMPACT;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `boxs`
--
ALTER TABLE `boxs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `num_box` (`num_box`);

--
-- Индексы таблицы `olts`
--
ALTER TABLE `olts`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `onu`
--
ALTER TABLE `onu`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_olt` (`id_olt`),
  ADD KEY `uidonu` (`uidonu`),
  ADD KEY `boxid` (`boxid`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `boxs`
--
ALTER TABLE `boxs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `olts`
--
ALTER TABLE `olts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `onu`
--
ALTER TABLE `onu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
