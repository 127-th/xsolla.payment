--
-- Структура таблицы `paymentList`
--

CREATE TABLE IF NOT EXISTS `paymentList` (
  `id` int(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `cardNumber` varchar(16) NOT NULL,
  `price` int(6) NOT NULL,
  `year` int(4) NOT NULL,
  `month` int(2) NOT NULL,
  `email` varchar(100) NOT NULL,
  `cvc` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `paymentList`
--

INSERT INTO `paymentList` (`id`, `name`, `cardNumber`, `price`, `year`, `month`, `email`, `cvc`) VALUES
(6, 'PAVEL BORDYUGOV', '4276834324767121', 981385, 2017, 3, 'pavelbordugov@gmail.com', 332);

