-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 10 2018 г., 18:20
-- Версия сервера: 5.7.16
-- Версия PHP: 7.0.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `account`
--

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `login` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `second_name` varchar(30) NOT NULL,
  `middle_name` varchar(30) NOT NULL,
  `gender` enum('men','women') NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `first_name`, `second_name`, `middle_name`, `gender`, `date`) VALUES
(32, 'anton', '$2y$10$xLUneEbtFfQrCf8/XZSGau1.3TYW2lGnqINMH4E2XDOW8WtX1IBcq', 'Антон', 'Евтушенко', 'Борисович', 'men', '2018-05-06'),
(40, 'alex0079', '$2y$10$PXe.cJmf0MGRCdccFFPJE.EW3gCzPqD9lr37sIYWslWtQ/wSvO/iu', 'Алексей', 'Истов', 'Гаврилович', 'men', '2018-05-02'),
(41, 'alex007', '$2y$10$yaF5PNTxUFaXgTypNX7lreWkEiM16en5K2v47VggCJFlO9gLl8Wiu', 'Александр', 'Киселев', 'Алексеевич', 'men', '1997-09-20'),
(42, 'ivan0079', '$2y$10$0k5MY0K.GnM.ujEdWKcBw.DEtNfn2iYS9tq9Mc.y0JYgzYJEStU/6', 'Иван', 'Истегнеев', 'Иудович', 'men', '2018-05-06'),
(43, 'Ignat', '$2y$10$yb9jIg.6sdK1igfG4SMR2ODVsFNRFjnn6hBt7tgQBwBdOvrJ9jZQm', 'Игнат', 'Мулидеев', 'Борисович', 'men', '1998-05-02'),
(44, 'limb.be', '$2y$10$.5ERR7qq8xzofwIvkK9PBOmuddbvZVwXCXSvefnujE2pKhU96HoMa', 'Анастасия', 'Поленкова', 'Владиславовна', 'women', '1997-05-22'),
(45, 'petr97', '$2y$10$fCNec/6G.jTo9YsrOEDbuONRW0F7A5mPbH0uhg95avXHLLWTsV.ni', 'Петр', 'Филев', 'Алексеевич', 'men', '1996-10-01'),
(49, 'natalia', '$2y$10$U8XxYFj38sndVku1.HX70eKgcRVHCEVqFJlAwRGBEstGOsIgycXfe', 'Наталья', 'Хохлова', 'Николаевна', 'men', '1995-05-07'),
(50, 'butorov', '$2y$10$PepqNdyaH.dQ9KJXoPxwVuP2w9pgrUYj927OZ.HFJuN9F2/xBMZGu', 'Иван', 'Буторов', 'Алексеевич', 'men', '1997-05-07'),
(51, 'gerg23', '$2y$10$hrCzy79IdCJpdKd5gNR3pu7lrFbE.VQ4O/Sy5VviRgslGQbeMAo66', 'Алексей', 'Орешков', 'Георгивич', 'men', '1997-05-05'),
(52, 'taeprog', '$2y$10$PFt0nMnBPlQz/wsz.Fu6xODDTbqtSFD0y/o/yUu5TyoK3Q5tiH882', 'Георгий', 'Гуторов', 'Алексеевич', 'men', '1984-06-06'),
(53, 'vlads', '$2y$10$Ol5HFd11pmu8lW1H5G64SuxNxxUkGM6x5LuZkQ4srVxvCZAAVP7mK', 'Влад', 'Мутаев', 'Сергеевич', 'men', '1962-05-05'),
(54, 'tuk-tuk', '$2y$10$2IzNeW0cYrGcJh.xgET6ZOSom77jqlSiel/3C.HSMVmDzqsjg2fv2', 'Алексей', 'Тутов', 'Икарович', 'men', '1984-04-06'),
(55, 'alina-e', '$2y$10$z7HaKX.5i/Ywb.Kmd1q/8O2pJWI3lxnNUnDSaTkVM1KwNKs43qrUK', 'Алина', 'Тупарева', 'Александровна', 'men', '1993-12-03'),
(56, 'vlada-e', '$2y$10$zRDsmk34B6dy5fpNhvvAeefVd8isbxTIWdfJ/fOfWLYkfsgPZ/xzC', 'Влада', 'Именова', 'Алексеевна', 'women', '1998-05-14'),
(57, '<script>alert(\'lose\')</script>', '$2y$10$DrilKf8ek9huD.MfeqKPG.4oIrjoQbHgawwdWfBHR9hy4h3fwMG3G', 'Хакер', 'Хакеров', 'Хакерович', 'men', '1985-01-04'),
(59, 'artur-2000', '$2y$10$N.zrCbGzvnTFxsfW71yaIuRJcRnDWcy2ru4cfsfIU2SkNhrp8Bcti', 'Артур', 'Кишенев', 'Сергеевич', 'men', '2000-01-01');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
