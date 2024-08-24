-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:8889
-- Время создания: Авг 06 2024 г., 20:36
-- Версия сервера: 5.7.39
-- Версия PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `zenblog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`) VALUES
(1, 'Business', 'business'),
(2, 'Culture', 'culture'),
(14, 'Sport', 'sport'),
(15, 'Food', 'food'),
(16, 'Politics', 'politics');

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `post_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `parent_id`, `post_id`, `user_id`, `message`, `created_at`) VALUES
(5, 0, 4, 1, 'hello this is test <p> BOLD</p>', '2024-06-07 13:44:46'),
(6, 5, 4, 1, 'test', '2024-06-07 13:46:12'),
(7, 0, 4, 4, 'hello', '2024-06-10 23:41:27'),
(8, 0, 9, 7, 'jhbkjgvkgh', '2024-08-06 00:20:37'),
(9, 0, 4, 6, 'Hi', '2024-08-06 22:34:42');

-- --------------------------------------------------------

--
-- Структура таблицы `media`
--

CREATE TABLE `media` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `media`
--

INSERT INTO `media` (`id`, `title`, `image`) VALUES
(5, 'test', 'http://localhost:8888/zenblog/uploads/2024/08/05/1b9f8b6f9d8a54789520f3d221f1ac59.jpg'),
(6, 'test 2', 'http://localhost:8888/zenblog/uploads/2024/08/05/9d2154c8281f2212dca0cd84e38d67eb.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `excerpt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `views` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `slug`, `excerpt`, `content`, `category_id`, `views`, `image`, `created_at`) VALUES
(2, 'post-2', 'post-2', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?', '<p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil, tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi itaque numquam aliquam soluta.</p>\r\n\r\n<p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil, tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi itaque numquam aliquam soluta.</p>\r\n\r\n<p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil, tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi itaque numquam aliquam soluta.</p>', 1, 1, 'http://localhost:8888/zenblog/uploads/2024/06/04/post-landscape-1.jpg', '2024-06-04 23:13:39'),
(4, 'post-4', 'post-10', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Distinctio placeat exercitationem magni voluptates dolore. Tenetur fugiat voluptates quas, nobis error deserunt aliquam temporibus sapiente, laudantium dolorum itaque libero eos deleniti?', '<p><b>Sunt</b> <b>reprehenderit</b>, hic vel optio odit est dolore, distinctio iure itaque enim pariatur ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil, tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi itaque numquam aliquam soluta.</p>\r\n\r\n<p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil, tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi itaque numquam aliquam soluta.</p>\r\n\r\n<p>Sunt reprehenderit, hic vel optio odit est dolore, distinctio iure itaque enim pariatur ducimus. Rerum soluta, perspiciatis voluptatum cupiditate praesentium repellendus quas expedita exercitationem tempora aliquam quaerat in eligendi adipisci harum non omnis reprehenderit quidem beatae modi. Ea fugiat enim libero, ipsam dicta explicabo nihil, tempore, nulla repellendus eos necessitatibus eligendi corporis cum? Eaque harum, eligendi itaque numquam aliquam soluta.</p>', 1, 46, 'http://localhost:8888/zenblog/uploads/2024/08/06/39cb3bc66c021abbfc1f4bc77434ba76.jpg', '2024-06-14 23:13:39'),
(9, 'post-1', 'post-1', 'Accusamus quia volup', 'Nihil dolor ad liber. Accusamus quia volup Accusamus quia volup Accusamus quia volup Accusamus quia volup Accusamus quia volup<br>', 2, 19, 'http://localhost:8888/zenblog/uploads/2024/06/10/accc5da7f9400c0b230bb030a9a668e6.png', '2024-06-10 23:35:53');

-- --------------------------------------------------------

--
-- Структура таблицы `post_tag`
--

CREATE TABLE `post_tag` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `post_tag`
--

INSERT INTO `post_tag` (`post_id`, `tag_id`) VALUES
(2, 1),
(2, 3),
(4, 1),
(4, 4),
(9, 2),
(9, 3),
(9, 5);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `tags`
--

INSERT INTO `tags` (`id`, `title`, `slug`) VALUES
(1, 'Business', 'business'),
(2, 'Culture', 'culture'),
(3, 'Sport', 'sport'),
(4, 'Food', 'food'),
(5, 'Politics', 'politics');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role`) VALUES
(6, 'Veda Lynch', 'admin@admin.com', '$2y$10$rXTODNucBU5G/B1F2UYS0esvJv0GBHBygdXwePdY1Rt7LRl3XZTGS', NULL, 1),
(7, 'Ainsley Heath', 'test@test.com', '$2y$10$3EXxk6KN0VVHSZxxnMXMe.hKP16jb.oh3YYhp76snFxi/emJX71oO', NULL, 1),
(8, 'Illana Hancock', 'taco@mailinator.com', '$2y$10$0qgu034KhDan9yD2nO6aVOLMsSEJcKPRGhsHpJMqz/zow1tahCs0i', NULL, 0);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `post_tag`
--
ALTER TABLE `post_tag`
  ADD PRIMARY KEY (`post_id`,`tag_id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `media`
--
ALTER TABLE `media`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
