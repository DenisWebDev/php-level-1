-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Мар 25 2019 г., 15:08
-- Версия сервера: 5.7.20
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `shop`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order`
--

DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `id_user` int(11) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `product_sum` int(11) NOT NULL,
  `status` tinyint(2) UNSIGNED NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `order_product`
--

DROP TABLE IF EXISTS `order_product`;
CREATE TABLE `order_product` (
  `id` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `image` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `price`, `image`) VALUES
(1, '4.95\" Смартфон DEXP GS150 8 черный', 'Смартфон DEXP GS150 имеет классический внешний вид: дизайн корпуса мобильного устройства оформлен с помощью черного цвета. Модель подходит для универсального применения. Наличие модуля 4G обуславливает возможность использования высокоскоростного подключения к Интернету с использованием мобильных сетей. Присутствует возможность использования двух SIM-карт. Поддерживается бесконтактная технология оплаты Google Pay. Автолюбители и туристы по достоинству оценят преимущества использования навигации, которая (при использовании соответствующих приложений) функционирует благодаря наличию GPS-модуля.\r\nСмартфон DEXP GS150 отличается высоким уровнем быстродействия, который достигается за счет сочетания 4-ядерного процессора MediaTek MT6739WA, 1 ГБ оперативной памяти и графического ускорителя PowerVR GE8100. Объем встроенной памяти равен 8 ГБ. Воспользовавшись соответствующим слотом, вы сможете установить карту памяти microSD, максимальный объем которой равен 64 ГБ. Литий-ионный аккумулятор, обеспечивающий питание смартфона, способен обеспечить работу модели в режиме разговора в течение 4.5 ч.', 4499, '2019-03-21-22-24-59-6370.jpg'),
(2, '15.6\" Ноутбук ASUS VivoBook D540MB-GQ116T черный', 'ASUS VivoBook - приятное сочетание технологий и классического дизайна. Стильный корпус, выполненный из высокопрочного пластика, никого не оставит равнодушным. Данный ноутбук - вариант для тех, кто привык окружить себя качественными и практичными устройствами.', 31999, '2019-03-21-22-25-13-8568.jpg'),
(3, '43\" (108 см) Телевизор LED Samsung UE43NU7090 черный', 'Телевизор Samsung оснащен экраном с диагональю 108 см. Модель Samsung UE43NU7090 обладает широким экраном 3840x2160 (4К), интеллектуальной системой управления Smart-TV, телегидом. Приложение для смартфона SmartThings app оснащено функциями универсального гида, пульта ДУ и панели управления.', 33999, '2019-03-21-22-25-19-8488.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `product_discount`
--

DROP TABLE IF EXISTS `product_discount`;
CREATE TABLE `product_discount` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `discount` tinyint(2) UNSIGNED NOT NULL,
  `date_from` timestamp NOT NULL,
  `date_to` timestamp NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `product_discount`
--

INSERT INTO `product_discount` (`id`, `id_product`, `discount`, `date_from`, `date_to`) VALUES
(1, 1, 20, '2019-02-28 21:00:00', '2019-12-30 21:00:00');

-- --------------------------------------------------------

--
-- Структура таблицы `review`
--

DROP TABLE IF EXISTS `review`;
CREATE TABLE `review` (
  `id` int(11) NOT NULL,
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_name` varchar(100) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` tinyint(1) NOT NULL DEFAULT '0',
  `date_add` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `role`, `date_add`) VALUES
(1, 'Admin', 'admin@site.loc', '$2y$10$SezmdJWTTHK9TuMSZhYGAeNdqqUE6kBbBwMGaM7.H9/xF53VUVjZO', 1, '2019-03-21 19:51:55'),
(2, 'Demo', 'demo@site.loc', '$2y$10$JXq9zDITXDpL3ed1hAhC1eqfZKlIqGR1/t0D9d2Y6iqsmmrhvzKj.', 0, '2019-03-21 19:52:54');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_user` (`id_user`,`id_product`);

--
-- Индексы таблицы `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `order_product`
--
ALTER TABLE `order_product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `product_discount`
--
ALTER TABLE `product_discount`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `order_product`
--
ALTER TABLE `order_product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `product_discount`
--
ALTER TABLE `product_discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `review`
--
ALTER TABLE `review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;
