-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Апр 12 2024 г., 14:39
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
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id_category` int(11) NOT NULL,
  `name_category` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id_category`, `name_category`) VALUES
(1, 'Газированные напитки'),
(2, 'Натуральные соки'),
(3, 'Горячие напитки'),
(4, 'Черный чай'),
(5, 'Зеленый чай'),
(6, 'Прохладительные напитки'),
(7, 'Вода'),
(8, 'Молочные напитки');

-- --------------------------------------------------------

--
-- Структура таблицы `categories_of_products`
--

CREATE TABLE `categories_of_products` (
  `id_product` int(11) NOT NULL,
  `id_category` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories_of_products`
--

INSERT INTO `categories_of_products` (`id_product`, `id_category`) VALUES
(1, 1),
(2, 4),
(2, 6),
(3, 3),
(4, 4),
(4, 6),
(5, 1),
(5, 6),
(6, 1),
(6, 6),
(6, 6),
(7, 2),
(8, 1),
(8, 5),
(8, 6);

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_order` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status_order` int(11) DEFAULT '1',
  `sum_order` decimal(10,0) NOT NULL,
  `bonus_minus` decimal(10,0) DEFAULT NULL,
  `bonus_plus` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `orders`
--

INSERT INTO `orders` (`id_order`, `id_user`, `date_order`, `status_order`, `sum_order`, `bonus_minus`, `bonus_plus`) VALUES
(1, 1, '2024-04-10 18:02:22', 1, '1115', '10', '75'),
(2, 4, '2024-04-12 13:54:58', 4, '250', '1', '1');

-- --------------------------------------------------------

--
-- Структура таблицы `order_row`
--

CREATE TABLE `order_row` (
  `id_order_row` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `amount_products` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `order_row`
--

INSERT INTO `order_row` (`id_order_row`, `id_order`, `id_product`, `amount_products`) VALUES
(1, 1, 2, 1),
(2, 1, 6, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name_product` varchar(37) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc_product` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_category_prod` int(11) NOT NULL,
  `image_product` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id_product`, `name_product`, `desc_product`, `id_category_prod`, `image_product`) VALUES
(1, 'Добрая Кола', 'Оригинальный вкус в новой упаковке. Газированный безалкогольный напиток Cola – напиток в металлической банке, освежает и тонизирует с первого глотка. Удивительный чайно-карамельный цвет, приятные пузырьки газа и ни с чем не сравнимый вкус.', 1, 'dobryCola.png'),
(2, 'Bubble Tea', 'чайный напиток, состоящий из чая (зелёного или чёрного), молока или фруктового сока, иногда кофе, с добавлением шариков из тапиоки', 6, 'boba.png'),
(3, 'Облепиховый глинтвейн', 'Пряности и специи в составе пунша обладают согревающими и тонизирующими свойствами, а натуральные соки облепихи, малины, апельсина и черной смородины обогащают организм витаминами, минералами и микроэлементами.', 6, 'punchGlintvine.png'),
(4, 'Виноградная комбуча', 'ферментированный черный чай, богатый пробиотиками и витамином B — восстанавливает волокна эластина и коллагена, помогает выводить токсины и укрепляет иммунитет кожи, борется с морщинами, выравнивает тон лица и оказывает общее омолаживающее действие на кожу лица', 4, 'combucha.png'),
(5, 'Милкис- вишня', 'Напиток, основанный на сочетании свежего молока с газированным лимонадом. Милкис является популярным продуктом Южной Кореи. Начали выпускать этот напиток с 1989 года.', 1, 'milkis.png'),
(6, 'Квас \"Очаковский\"', 'Квас обладает отличными вкусовыми качествами. Он утоляет жажду благодаря содержащимся в нём кислотам — молочной и отчасти уксусной, обладает высокой энергетической ценностью и способствует пищеварению.', 6, 'kvas.png'),
(7, 'Сок \"Киви\"', 'Сок киви — вкусный и очень полезный напиток, который поможет оперативно восполнить все необходимые организму витамины и минералы, полноценно подготовиться к встрече с сезоном вирусов и простуд.', 2, 'kiwi.png'),
(8, 'Чай зеленый', 'Освежающий напиток на основе зеленого чая, который богат антиоксидантами и питательными веществами. В его составе очищенная вода, кукурузный сироп, специальная формула экстракта женьшеня, мед, а также витамины A, C и E, благоприятно влияющие на организм.', 6, 'arizona.png\r\n');

-- --------------------------------------------------------

--
-- Структура таблицы `status_orders`
--

CREATE TABLE `status_orders` (
  `id_status` int(11) NOT NULL,
  `name_status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `status_orders`
--

INSERT INTO `status_orders` (`id_status`, `name_status`) VALUES
(4, 'Выполнен'),
(2, 'Готовим'),
(3, 'Доставка'),
(1, 'Создан');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `email_user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_user` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `bonuses_active` decimal(10,0) NOT NULL DEFAULT '0',
  `admin_status` int(11) NOT NULL DEFAULT '0',
  `blocked` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id_user`, `email_user`, `password_user`, `bonuses_active`, `admin_status`, `blocked`) VALUES
(1, 'diamond@mail.com', 'diamond', '0', 1, 0),
(2, 'cherevata@mail.com', 'elenacherevata', '0', 0, 0),
(4, 'tishka@mail.com', 'babyTishka', '0', 0, 0),
(5, 'timofey@mail.com', 'robocop', '0', 0, 0),
(6, 'anokhina@mail.com', 'lisaAa', '0', 0, 0),
(7, 'popo@mail.com', 'popo', '0', 0, 0),
(8, 'dobry@mail.com', 'dobry', '0', 0, 0),
(9, 'diablo@mail.com', 'diablo', '0', 0, 0),
(10, 'own@mail.ru', 'ownown', '0', 0, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `volumes`
--

CREATE TABLE `volumes` (
  `id_volume_prod` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `volume_of_prod` decimal(3,2) NOT NULL,
  `price_volume` int(11) NOT NULL DEFAULT '100'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `volumes`
--

INSERT INTO `volumes` (`id_volume_prod`, `id_product`, `volume_of_prod`, `price_volume`) VALUES
(3, 1, '0.33', 70),
(4, 1, '0.45', 90),
(5, 1, '1.00', 135),
(6, 2, '0.33', 100),
(7, 2, '0.50', 170),
(8, 2, '0.70', 250),
(9, 3, '0.50', 130),
(10, 3, '0.70', 180),
(11, 4, '0.33', 85),
(12, 4, '0.50', 130),
(13, 4, '0.70', 180),
(14, 5, '0.33', 45),
(15, 6, '0.33', 65),
(16, 6, '0.50', 100),
(17, 6, '1.00', 150),
(18, 7, '0.33', 85),
(19, 7, '0.45', 100),
(20, 7, '1.00', 150),
(21, 8, '0.45', 100),
(22, 8, '0.70', 160);

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
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id_category`);

--
-- Индексы таблицы `categories_of_products`
--
ALTER TABLE `categories_of_products`
  ADD KEY `id_product` (`id_product`,`id_category`),
  ADD KEY `id_category` (`id_category`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `id_user` (`id_user`),
  ADD KEY `status_order` (`status_order`);

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
  ADD KEY `id_cathegory_prod` (`id_category_prod`);

--
-- Индексы таблицы `status_orders`
--
ALTER TABLE `status_orders`
  ADD PRIMARY KEY (`id_status`),
  ADD KEY `name_status` (`name_status`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `id_user` (`email_user`);

--
-- Индексы таблицы `volumes`
--
ALTER TABLE `volumes`
  ADD PRIMARY KEY (`id_volume_prod`),
  ADD KEY `id_product` (`id_product`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `bin`
--
ALTER TABLE `bin`
  MODIFY `id_bin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id_category` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `order_row`
--
ALTER TABLE `order_row`
  MODIFY `id_order_row` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `status_orders`
--
ALTER TABLE `status_orders`
  MODIFY `id_status` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `volumes`
--
ALTER TABLE `volumes`
  MODIFY `id_volume_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `bin`
--
ALTER TABLE `bin`
  ADD CONSTRAINT `bin_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `categories_of_products`
--
ALTER TABLE `categories_of_products`
  ADD CONSTRAINT `categories_of_products_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `categories_of_products_ibfk_2` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `users` (`id_user`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`status_order`) REFERENCES `status_orders` (`id_status`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`id_category_prod`) REFERENCES `categories` (`id_category`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `volumes`
--
ALTER TABLE `volumes`
  ADD CONSTRAINT `volumes_ibfk_1` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
