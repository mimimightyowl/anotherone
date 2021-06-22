-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 22, 2021 at 10:34 AM
-- Server version: 5.7.24
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `second`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(3) NOT NULL,
  `name` varchar(16) NOT NULL,
  `country` varchar(16) NOT NULL,
  `country_eng` varchar(32) NOT NULL DEFAULT 'Неизвестно'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `country`, `country_eng`) VALUES
(1, 'Ижевск', 'Россия', 'russia'),
(2, 'Иркутск', 'Россия', 'russia'),
(3, 'Казань', 'Россия', 'russia'),
(4, 'Новгород', 'Россия', 'russia'),
(5, 'Москва', 'Россия', 'russia'),
(6, 'Тюмень', 'Россия', 'russia'),
(8, 'Санкт-Петербург', 'Россия', 'russia'),
(9, 'Самара', 'Россия', 'russia'),
(10, 'Саратов', 'Россия', 'russia'),
(11, 'Бухарест', 'Румыния', 'romania'),
(12, 'Яссы', 'Румыния', 'romania'),
(13, 'Галац', 'Румыния', 'romania'),
(14, 'Крайова', 'Румыния', 'romania'),
(15, 'Бакэу', 'Румыния', 'romania'),
(16, 'Брэила', 'Румыния', 'romania'),
(17, 'Арад', 'Румыния', 'romania'),
(18, 'Питешти', 'Румыния', 'romania'),
(19, 'Орадя', 'Румыния', 'romania'),
(20, 'Плоешти', 'Румыния', 'romania'),
(21, 'Алингос', 'Швеция', 'sweden'),
(22, 'Арбуга', 'Швеция', 'sweden'),
(23, 'Буден', 'Швеция', 'sweden'),
(24, 'Бурленге', 'Швеция', 'sweden'),
(25, 'Бурос', 'Швеция', 'sweden'),
(26, 'Вадстена', 'Швеция', 'sweden'),
(27, 'Варберг', 'Швеция', 'sweden'),
(28, 'Векшё', 'Швеция', 'sweden'),
(29, 'Венерсборг', 'Швеция', 'sweden'),
(30, 'Арбуга', 'Швеция', 'sweden'),
(31, 'Вестервик', 'Швеция', 'sweden'),
(32, 'Арбуга', 'Швеция', 'sweden'),
(33, 'Вестерос', 'Швеция', 'sweden'),
(34, 'Висбю', 'Швеция', 'sweden'),
(35, 'Кигали', 'Руанда', 'rwanda'),
(36, 'Рубаву', 'Руанда', 'rwanda'),
(37, 'Мусанзе', 'Руанда', 'rwanda'),
(38, 'Хуе', 'Руанда', 'rwanda'),
(39, 'Муханга', 'Руанда', 'rwanda'),
(40, 'Кабуга', 'Руанда', 'rwanda'),
(41, 'Гичумби', 'Руанда', 'rwanda'),
(42, 'Русизи', 'Руанда', 'rwanda'),
(43, 'Ньянза', 'Руанда', 'rwanda'),
(44, 'Бугарама', 'Руанда', 'rwanda'),
(45, 'Альтдорф', 'Швейцария', 'switzerland'),
(46, 'Арау', 'Швейцария', 'switzerland'),
(47, 'Базель', 'Швейцария', 'switzerland'),
(48, 'Берн', 'Швейцария', 'switzerland'),
(49, 'Веве', 'Швейцария', 'switzerland'),
(50, 'Вильнёв', 'Швейцария', 'switzerland'),
(51, 'Винтертур', 'Швейцария', 'switzerland'),
(52, 'Женева', 'Швейцария', 'switzerland'),
(53, 'Цюрих', 'Швейцария', 'switzerland'),
(54, 'Люцерн', 'Швейцария', 'switzerland');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(2) NOT NULL,
  `name` varchar(16) NOT NULL,
  `country` varchar(32) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `country`) VALUES
(1, 'Россия', 'russia'),
(2, 'Румыния', 'romania'),
(3, 'Швеция', 'sweden'),
(4, 'Руанда', 'rwanda'),
(5, 'Швейцария', 'switzerland');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
