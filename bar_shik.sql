-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 29 2024 г., 20:49
-- Версия сервера: 5.7.39
-- Версия PHP: 8.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `bar_shik`
--

-- --------------------------------------------------------

--
-- Структура таблицы `bin`
--

CREATE TABLE `bin` (
  `id_bin` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `into_bin` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `cathegories`
--

CREATE TABLE `cathegories` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_order` varchar(150) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sum_order` decimal(10,0) NOT NULL,
  `bonus_minus` decimal(10,0) DEFAULT NULL,
  `bonus_plus` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `order_row`
--

CREATE TABLE `order_row` (
  `id_order_row` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_cathegory_prod` int(11) NOT NULL,
  `price_product` decimal(10,0) NOT NULL,
  `image_product` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonuses_active` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `bin`
--
ALTER TABLE `bin`
  ADD PRIMARY KEY (`id_bin`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `cathegories`
--
ALTER TABLE `cathegories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`);

--
-- Индексы таблицы `order_row`
--
ALTER TABLE `order_row`
  ADD PRIMARY KEY (`id_order_row`),
  ADD KEY `id_order` (`id_order`,`id_product`),
  ADD KEY `id_product` (`id_product`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `id_cathegory_prod` (`id_cathegory_prod`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`email_user`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bin`
--
ALTER TABLE `bin`
  MODIFY `id_bin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `cathegories`
--
ALTER TABLE `cathegories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_row`
--
ALTER TABLE `order_row`
  MODIFY `id_order_row` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bin`
--
ALTER TABLE `bin`
  ADD CONSTRAINT `bin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_row`
--
ALTER TABLE `order_row`
  ADD CONSTRAINT `order_row_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_row_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_cathegory_prod`) REFERENCES `cathegories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
