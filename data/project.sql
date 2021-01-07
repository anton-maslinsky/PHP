-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 05 2021 г., 14:47
-- Версия сервера: 8.0.19
-- Версия PHP: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `project`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `id` int NOT NULL,
  `product_id` int NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `qty` int NOT NULL DEFAULT '1',
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL DEFAULT 'new'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `cart`
--

INSERT INTO `cart` (`id`, `product_id`, `session_id`, `qty`, `status`) VALUES
(132, 3, 'k2vavnutc1m692nn4ijb5s2jfoduhugd', 2, 'accepted'),
(133, 8, 'k2vavnutc1m692nn4ijb5s2jfoduhugd', 2, 'accepted'),
(134, 1, 'k2vavnutc1m692nn4ijb5s2jfoduhugd', 1, 'accepted'),
(135, 3, '385051ac8maa3rsidr2mr6shcs6ckrh6', 1, 'accepted'),
(136, 2, 's5isg0tlq5r0588fa0278oamqca3u3dg', 2, 'accepted'),
(137, 1, 's5isg0tlq5r0588fa0278oamqca3u3dg', 2, 'accepted'),
(138, 3, 's5isg0tlq5r0588fa0278oamqca3u3dg', 1, 'accepted'),
(139, 6, '7pi35rq0cs4pei68clu62dlc4ol4qq5b', 2, 'accepted'),
(140, 7, '7pi35rq0cs4pei68clu62dlc4ol4qq5b', 1, 'accepted'),
(141, 8, '7pi35rq0cs4pei68clu62dlc4ol4qq5b', 2, 'accepted');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `feedback` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `feedback`
--

INSERT INTO `feedback` (`id`, `name`, `feedback`) VALUES
(2, 'Сергей', 'Сервис работает.'),
(3, 'Admin', 'Привет!'),
(4, 'Admin', 'Hello!'),
(7, 'Антон', 'Сервис работает. На switch'),
(35, 'Admin', 'Добро пожаловать!'),
(43, 'Антон', 'Проверка....'),
(44, 'Admin', 'Проверка прошла. Работает! :) '),
(45, 'Антон', 'saDs'),
(48, 'Фёдор', 'Привет!'),
(49, 'Антон', 'Привет!');

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `likes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `images`
--

INSERT INTO `images` (`id`, `name`, `likes`) VALUES
(7, '01.jpg', 2),
(8, '02.jpg', 3),
(9, '03.jpg', 1),
(10, '04.jpg', 2),
(11, '05.jpg', 2),
(12, '06.jpg', 0),
(13, '09.jpg', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id`, `user_name`, `phone`, `session_id`, `status`) VALUES
(48, 'anton', '9997777777', 'k2vavnutc1m692nn4ijb5s2jfoduhugd', 'accepted'),
(49, 'mike', '9217776655', '385051ac8maa3rsidr2mr6shcs6ckrh6', 'accepted'),
(50, 'andrey', '9119110012', 's5isg0tlq5r0588fa0278oamqca3u3dg', 'accepted'),
(51, 'stepan', '921-777-1300', '7pi35rq0cs4pei68clu62dlc4ol4qq5b', 'accepted');

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `descr` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `full_descr` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `likes` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `descr`, `full_descr`, `price`, `likes`) VALUES
(1, 'Название продукта', 'product_1.png', 'Описание продукта', 'Полное описание продукта', '100', 23),
(2, 'Название продукта', 'product_2.png', 'Описание продукта', 'Полное описание продукта', '200', 13),
(3, 'Название продукта', 'product_3.png', 'Описание продукта', 'Полное описание продукта', '400', 6),
(4, 'Название продукта', 'product_4.png', 'Описание продукта', 'Полное описание продукта', '450', 2),
(5, 'Название продукта', 'product_5.png', 'Описание продукта', 'Полное описание продукта', '320', 1),
(6, 'Название продукта', 'product_6.png', 'Описание продукта', 'Полное описание продукта', '120', 1),
(7, 'Название продукта', 'product_7.png', 'Описание продукта', 'Полное описание продукта', '1500', 1),
(8, 'Название продукта', 'product_8.png', 'Описание продукта', 'Полное описание продукта', '500', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `user_name`, `login`, `pass`, `hash`) VALUES
(3, 'admin', 'admin', '$2y$10$9pDioEUziw1ms5Awww0fteSD3Lw8l5Y92XBRWX/ultyt1ZmuJKIf2', '15690676355ff349b193f130.06728361'),
(9, 'Антон', 'anton', '$2y$10$XtFgXEOSeWOyPLiGthtDue3qAAYQDkaJC83XY5rFhlnr6RqEh6Wd.', ''),
(12, 'Сергей', 'sergey', '$2y$10$Qn5NhR1VTJIG5FnhZcDV7uYTfHmZEm0metKiCW0bk1Ax5OLpdSAsK', '1402992315fe8f66f04c9a1.78964134'),
(13, 'Фёдор', 'fedor', '$2y$10$lcAqWv0SZF6xWglr7W0.F.P7gkBNJmadFDNLVo06MCkn0sQERtpiy', '1434691895ff323f68ef234.82505329'),
(21, 'Михаил', 'mike', '$2y$10$vuAE.M4yydBHbhUbVAdXC.IIk1wS.4mtLa7EzMqzwvnczxa0J94di', '6870481405ff3880d242429.74885103'),
(22, 'Андрей', 'andrey', '$2y$10$b7HyJVDukcMVJKdNvjLhSuh7n.WAk13CuSY5Xlsi1GYMu/EF8zKzS', '15492639475ff43274012ca2.15106794'),
(23, 'Степан', 'stepan', '$2y$10$NIQOJaxSUroSo2sqtwKDeu8ikTRluMlbqtFemO72XU.ZMe.DRMxhK', '18988753035ff43f0ab08c37.91680985');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=142;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
