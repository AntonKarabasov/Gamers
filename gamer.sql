-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Мар 03 2022 г., 15:32
-- Версия сервера: 8.0.28-0ubuntu0.20.04.3
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `gamer`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `news_id` int NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `author_id`, `news_id`, `text`, `created_at`) VALUES
(13, 23, 44, 'Мега', '2022-02-09 12:29:23'),
(15, 22, 27, 'новый коммент', '2022-02-17 11:49:36'),
(19, 22, 27, '<br />\r\nr4tr4trt\\<br />\r\nhjk,mhj,mujm,', '2022-02-26 16:29:46'),
(20, 22, 44, 'Проверочка', '2022-03-03 12:06:44');

-- --------------------------------------------------------

--
-- Структура таблицы `game`
--

CREATE TABLE `game` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descriptions` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` float NOT NULL,
  `year` int NOT NULL,
  `date` float NOT NULL,
  `link_poster` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `link_video` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `game`
--

INSERT INTO `game` (`id`, `name`, `descriptions`, `rating`, `year`, `date`, `link_poster`, `link_video`, `add_date`) VALUES
(2, 'Red Dead Redemption 2', 'Америка, 1899 год. Эпоха Дикого Запада подходит к концу. Служители закона методично охотятся на остатки банд. Тех, кто не желает сдаться, убивают.', 9.7, 2018, 26.11, 'http://gamer.test/assets/img/poster/Red Dead Redemption 2.webp', 'https://www.youtube.com/embed/eaW0tYpxyp0', '2021-12-02 12:29:01'),
(3, 'The Elder Scrolls 5: Skyrim', 'Пятая часть легендарного ролевого сериала. Сюжетно Skyrim — это прямое продолжение Oblivion. Впрочем, на этот раз героев ждут куда более серьезные противники — драконы.', 9.4, 2011, 11.11, 'http://gamer.test/assets/img/poster/The Elder Scrolls 5: Skyrim.webp', 'https://www.youtube.com/embed/JSRtYpNRoN0', '2021-12-02 13:23:04'),
(4, 'Cyberpunk 2077', 'Cyberpunk 2077 — приключенческая ролевая игра, действие которой происходит в мегаполисе Найт-Сити, где власть, роскошь и модификации тела ценятся выше всего. Вы играете за V, наёмника в поисках устройства, позволяющего обрести бессмертие. Вы сможете менять киберимпланты, навыки и стиль игры своего персонажа, исследуя открытый мир, где ваши поступки влияют на ход сюжета и всё, что вас окружает.', 8.6, 2020, 10.12, 'http://gamer.test/assets/img/poster/Cyberpunk 2077.webp', 'https://www.youtube.com/embed/8X2kIfS6fb8', '2021-12-08 10:52:53'),
(5, 'Grand Theft Auto: The Trilogy', 'Grand Theft Auto: The Trilogy — The Definitive Edition — сборник компьютерных игр в жанре action-adventure, представляющий собой ремастерированные версии трёх игр во франшизе Grand Theft Auto: Grand Theft Auto III, Grand Theft Auto: Vice City и Grand Theft Auto: San Andreas.', 4.9, 2021, 11.11, 'http://gamer.test/assets/img/poster/Grand Theft Auto: The Trilogy.webp', 'https://www.youtube.com/embed/4E7bJOdiQiE', '2021-12-08 10:52:53'),
(6, 'Forza Horizon 5', 'Forza Horizon 5 — компьютерная игра в жанре аркадного гоночного симулятора. В качестве разработчика выступает компания Playground Games, а в качестве издателя — Xbox Game Studios. ', 9.1, 2021, 9.11, 'http://gamer.test/assets/img/poster/Forza Horizon 5.webp', 'https://www.youtube.com/embed/U3mEOHvSUyw', '2021-12-08 10:52:53'),
(7, 'S.T.A.L.K.E.R.: Shadow of Chernobyl', 'S.T.A.L.K.E.R. — игра-миф, игра-опасность, игра-предупреждение, в основе которой лежат многочисленные легенды чернобыльской Зоны, все эти мрачные отголоски эха катастрофы двадцатилетней давности. В наши дни, по сути, никто толком не знает, что происходит внутри бетонного саркофага печально известного четвертого реактора ЧАЭС, и сюжет игры основан на классическом историческом допущении в духе «а что если?». А что если в 2006 году реакция внутри реактора спровоцировала новый взрыв?', 8.2, 2007, 19.03, 'http://gamer.test/assets/img/poster/S.T.A.L.K.E.R.: Shadow of Chernobyl.webp', 'https://www.youtube.com/embed/wGD4bRFMRlY', '2021-12-08 10:52:53'),
(8, 'Fallout 4', 'Вы – единственный выживший из убежища 111, оказавшийся в мире, разрушенном ядерной войной. Каждый миг вы сражаетесь за выживание, каждое решение может стать последним. Но именно от вас зависит судьба пустошей. Добро пожаловать домой.', 8.4, 2015, 10.11, 'http://gamer.test/assets/img/poster/Fallout 4.webp', 'https://www.youtube.com/embed/X5aJfebzkrM', '2021-12-08 10:52:53'),
(9, 'Resident Evil 3 (2020)', 'Resident Evil 3 — компьютерная игра, являющаяся ремейком игры Resident Evil 3: Nemesis 1999 года, а также продолжением двух предыдущих ремейков серии — Resident Evil и частично Resident Evil 2.', 7.7, 2020, 4.03, 'http://gamer.test/assets/img/poster/Resident Evil 3 (2020).webp', 'https://www.youtube.com/embed/9LrLM4Hvr9U', '2021-12-08 10:52:53'),
(10, 'Uncharted 4: A Thief\'s End', 'Натан Дрейк пообещал навсегда отказаться от приключений, и теперь он живет мирной жизнью вместе со своей женой Еленой Фишер. Но неожиданное возвращение из мертвых старшего брата Сэма втягивает героя в головокружительную авантюру.', 9.3, 2016, 10.05, 'http://gamer.test/assets/img/poster/Uncharted 4: A Thief\'s End.webp', 'https://www.youtube.com/embed/hh5HV4iic1Y', '2021-12-08 10:52:53'),
(11, 'God of War (2018)', 'God of War представляет собой своеобразный перезапуск серии, в котором камера размещается за плечом персонажа. Греческая мифология сменится скандинавской, а главный герой Кратос обзаведется женой и сыном.', 9.4, 2018, 20.04, 'http://gamer.test/assets/img/poster/God of War (2018).webp', 'https://www.youtube.com/embed/K0u_kAWLJOA', '2021-12-08 10:52:53'),
(13, 'The Last of Us: Part 2', 'The Last of Us Part II — компьютерная игра в жанре приключенческого боевика с элементами survival horror и стелс-экшена от третьего лица, разработанная компанией Naughty Dog и изданная Sony Interactive Entertainment в 2020 году для игровой приставки PlayStation 4.', 9.3, 2020, 19.06, 'http://gamer.test/assets/img/poster/The Last of Us: Part 2.webp', 'https://www.youtube.com/embed/qPNiIeKMHyg', '2021-12-08 10:52:53'),
(14, 'Metro Exodus', 'В Metro: Exodus игрокам предстоит исследовать просторы постапокалиптической России на обширных нелинейных уровнях в рамках увлекательного сюжета. Главным героем игр вновь станет Артем, которого ждет новое приключение в опасном и жестоком мире. ', 8.2, 2019, 15.02, 'http://gamer.test/assets/img/poster/Metro Exodus.webp', 'https://www.youtube.com/embed/fbbqlvuovQ0', '2021-12-08 10:52:53'),
(15, 'Devil May Cry 5', 'В пятой части легендарной серии Devil May Cry вы вновь сможете насладиться сверхскоростными сражениями с участием невероятных персонажей. Новейшие технологии компьютерной графики позволили Capcom создать этот непревзойденный шедевр жанра экшен.', 8.8, 2019, 8.03, 'http://gamer.test/assets/img/poster/Devil May Cry 5.webp', 'https://www.youtube.com/embed/KMSGj9Y2T9Q', '2021-12-08 10:52:53'),
(16, 'Divinity: Original Sin 2', 'Divinity: Original Sin 2 — это продолжение пошаговой ролевой игры 2014 года. Игра сохранила все лучшие черты оригинала, в том числе и безграничную свободу, и обзавелась новым пользовательским интерфейсом, художественным стилем и улучшенной ролевой системой. Игроки смогут исследовать мир как в одиночку, так и в компании троих друзей.', 9.5, 2017, 14.09, 'http://gamer.test/assets/img/poster/Divinity: Original Sin 2.webp', 'https://www.youtube.com/embed/vJ4SVSm1ARQ', '2021-12-08 10:52:53'),
(17, 'Prey (2017)', 'Prey — научно-фантастический экшен от первого лица. Игрокам в роли Морган Ю предстоит исследовать космическую станцию Талос-I, которую захватили пришельцы — тифоны. Протагонист во время прохождения сможет изучить инопланетные способности и использовать их против врагов.', 8, 2017, 5.05, 'http://gamer.test/assets/img/poster/Prey (2017).webp', 'https://www.youtube.com/embed/q38yi0NmAm0', '2021-12-08 10:52:53'),
(18, 'Sid Meier\'s Civilization 6', 'Sid Meier’s Civilization VI — компьютерная игра серии Civilization в жанре пошаговая стратегия, разработанная Firaxis Games и выпущенная 21 октября 2016 года', 9.1, 2016, 21.1, 'http://gamer.test/assets/img/poster/Sid Meier\'s Civilization 6.webp', 'https://www.youtube.com/embed/5KdE0p2joJw', '2021-12-08 10:52:53'),
(19, 'Batman: Arkham Knight', 'Четвертая часть игровой серии о Темном Рыцаре. В Batman: Arkham Knight игрокам будет доступен для изучения целый Готэм, а перемещаться по нему герой будет на настоящем бэтмобиле. По мере прохождения Бэтмен встретится со многими своими знаменитыми врагами и союзниками.', 8.7, 2015, 23.06, 'http://gamer.test/assets/img/poster/Batman: Arkham Knight.webp', 'https://www.youtube.com/embed/wsf78BS9VE0', '2021-12-08 10:52:53'),
(20, 'Project CARS', 'Игра Project CARS, протестированная и одобренная страстными поклонниками гонок и реальными гонщиками, принимавшими участие также и в ее создании, представляет собой гоночный симулятор нового поколения, который вобрал в себя невероятную комбинацию фанатской страсти и высокого профессионализма разработчиков', 8.3, 2015, 7.05, 'http://gamer.test/assets/img/poster/Project CARS.webp', 'https://www.youtube.com/embed/nCYq7eiO5X4', '2021-12-08 10:52:53'),
(21, 'Hellblade: Senua\'s Sacrifice', 'В эпоху викингов измученная кельтская воительница отправляется в ужасную страну мертвых, чтобы сразиться за душу погибшего возлюбленного.', 8.3, 2017, 8.08, 'http://gamer.test/assets/img/poster/Hellblade: Senua\'s Sacrifice.jpeg', 'https://www.youtube.com/embed/fBJ0ifVtK5c', '2021-12-08 10:52:53'),
(22, 'Dark Souls 3', 'Сюжет Dark Souls 3 перенесет игроков в Лотрик, где им предстоит взять на себя роль Повелителя Пепла и в дальнейшем определить роль огня в будущем человечества.', 8.9, 2016, 12.04, 'http://gamer.test/assets/img/poster/Dark Souls 3.webp', 'https://www.youtube.com/embed/cWBwFhUv1-8', '2021-12-08 10:52:53'),
(35, 'Resident Evil: Village', 'Игра является прямым продолжением Resident Evil 7 и снова предлагает игрокам взять на себя роль Итана Уинтерса. Итан и его жена Миа поселились на новом месте, вдали от ужасов прошлого. Но прежде чем супруги успели насладиться безмятежной жизнью, как их снова постигла трагедия.', 8.4, 2021, 7.05, 'http://gamer.test/assets/img/poster/Resident Evil: Village.jpg', 'https://www.youtube.com/embed/YGQ_YtpTwdc', '2022-01-29 16:13:03'),
(44, 'Marvel’s Guardians of the Galaxy', '<p>Приключенческий боевик, дающий игрокам возможность попробовать себя в роли Звёздного Лорда.</p>\r\n\r\n<p>Возглавьте причудливую команду, командуйте ими и подавляйте врагов своими фирменными приёмами: от выстрелов стихийным уроном из бластеров и управления реактивными ботинками до коллективных добиваний.</p>', 8, 2021, 26.1, 'http://gamer.test/assets/img/poster/Marvel’s Guardians of the Galaxy.jpg', 'https://www.youtube.com/embed/QBn8ST8rELc', '2022-01-31 13:56:08'),
(45, 'Hitman 3', 'Заключительная часть трилогии World of Assassination. Вам снова необходимо примерить на себе роль Агента 47 и приступить к выполнению заказов, ликвидируя необходимые цели. Как и в предыдущих частях игры вы можете выбирать абсолютно любую маскировку, подстраивать «несчастные случаи», взаимодействовать с другими персонажами, сливаться с толпой и многое другое.', 8.1, 2021, 20.01, 'http://gamer.test/assets/img/poster/Hitman 3.jpg', 'https://www.youtube.com/embed/avAXhnbs69w', '2022-01-31 21:15:55'),
(54, 'Elden Ring', 'Экшен с ролевыми элементами от студий FromSoftware и Bandai Namco Entertainment, события которого разворачиваются в фэнтезийном мире. В разработке игры принимал участие Хидэтаки Миядзаки — родоначальник серии Dark Souls, и Джордж Р. Р. Мартин — автор популярной книжной серии «Песня льда и огня».', 9.7, 2022, 25.02, 'http://gamer.test/assets/img/poster/Elden Ring.jpg', 'https://www.youtube.com/embed/AKXiKBnzpBQ', '2022-02-24 14:09:55'),
(55, 'The Legend of Zelda: Breath of the Wild', 'Эксклюзивный приключенческий экшен для консолей Nintendo Switch и Wii U. Авторы решили отойти от привычной концепции серии, сделав больший акцент на открытом мире. Игроков ждет множество подземелий с головоломками, большой выбор оружия и снаряжения и опасные враги.', 9.7, 2017, 3.03, 'http://gamer.test/assets/img/poster/The Legend of Zelda: Breath of the Wild.jpg', 'https://www.youtube.com/embed/1rPxiXXxftE', '2022-02-26 12:10:06'),
(56, 'Grand Theft Auto 5', 'В центре пятой части сразу трое героев — Майкл, Франклин и Тревор. В Grand Theft Auto 5 есть все, за то мы так любим эту серию: и криминальная драма, и огромный, проработанный до мелких деталей игровой мир и неограниченная свобода действия.', 9.7, 2013, 2.11, 'http://gamer.test/assets/img/poster/Grand Theft Auto 5.jpg', 'https://www.youtube.com/embed/QkkoHAzjnUs', '2022-02-26 12:22:57');

-- --------------------------------------------------------

--
-- Структура таблицы `game_genres`
--

CREATE TABLE `game_genres` (
  `genres_id` int NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `game_genres`
--

INSERT INTO `game_genres` (`genres_id`, `game_id`) VALUES
(1, 2),
(1, 4),
(1, 5),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 13),
(1, 14),
(1, 15),
(1, 17),
(1, 19),
(1, 21),
(1, 22),
(1, 35),
(1, 44),
(1, 54),
(1, 55),
(1, 56),
(2, 2),
(2, 5),
(2, 9),
(2, 10),
(2, 13),
(2, 44),
(2, 45),
(2, 56),
(3, 4),
(3, 7),
(3, 8),
(3, 14),
(3, 17),
(3, 35),
(4, 3),
(4, 4),
(4, 8),
(4, 16),
(4, 22),
(5, 54),
(5, 55),
(6, 18),
(7, 6),
(7, 20),
(10, 14),
(10, 19),
(10, 45),
(11, 7),
(11, 9),
(11, 13),
(11, 35),
(13, 11),
(13, 15);

-- --------------------------------------------------------

--
-- Структура таблицы `game_platforms`
--

CREATE TABLE `game_platforms` (
  `platforms_id` int NOT NULL,
  `game_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `game_platforms`
--

INSERT INTO `game_platforms` (`platforms_id`, `game_id`) VALUES
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 35),
(1, 44),
(1, 45),
(1, 54),
(1, 56),
(2, 3),
(2, 56),
(3, 2),
(3, 3),
(3, 4),
(3, 5),
(3, 8),
(3, 9),
(3, 10),
(3, 11),
(3, 13),
(3, 14),
(3, 15),
(3, 16),
(3, 17),
(3, 18),
(3, 19),
(3, 20),
(3, 21),
(3, 22),
(3, 35),
(3, 44),
(3, 45),
(3, 54),
(3, 56),
(4, 3),
(4, 4),
(4, 5),
(4, 6),
(4, 10),
(4, 14),
(4, 15),
(4, 35),
(4, 44),
(4, 45),
(4, 54),
(4, 56),
(5, 3),
(5, 56),
(6, 2),
(6, 3),
(6, 4),
(6, 5),
(6, 8),
(6, 9),
(6, 14),
(6, 15),
(6, 16),
(6, 17),
(6, 18),
(6, 19),
(6, 20),
(6, 21),
(6, 22),
(6, 35),
(6, 44),
(6, 45),
(6, 54),
(6, 56),
(7, 3),
(7, 4),
(7, 5),
(7, 6),
(7, 14),
(7, 15),
(7, 21),
(7, 35),
(7, 44),
(7, 45),
(7, 54),
(7, 56),
(8, 55),
(9, 3),
(9, 5),
(9, 16),
(9, 18),
(9, 21),
(9, 44),
(9, 45),
(9, 55);

-- --------------------------------------------------------

--
-- Структура таблицы `genres`
--

CREATE TABLE `genres` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `genres`
--

INSERT INTO `genres` (`id`, `name`) VALUES
(1, 'Action-adventure'),
(2, 'TPS'),
(3, 'FPS'),
(4, 'RPG'),
(5, 'RTS'),
(6, 'TBS'),
(7, 'Racing'),
(8, 'Fighting'),
(9, 'Quest'),
(10, 'Stealth'),
(11, 'Horror'),
(12, 'MMORPG'),
(13, 'Slasher'),
(14, 'Sport');

-- --------------------------------------------------------

--
-- Структура таблицы `news`
--

CREATE TABLE `news` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `link_img` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'http://gamer.test/assets/img/news/',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `news`
--

INSERT INTO `news` (`id`, `author_id`, `name`, `text`, `link_img`, `created_at`) VALUES
(27, 22, 'Состоялся анонс Crysis 4', 'Как пишут разработчики, подтверждая ранние сведения портала Сhampionat, новая игра находится на ранней стадии производства, а сама студия разыскивает специалистов для проекта.\r\nКроме того, Crytek намеревается и дальше активно разивать другое своё творение, Hunt: Showdown.', 'http://gamer.test/assets/img/news/news27.jpg', '2022-01-26 14:08:23'),
(36, 22, 'В Back 4 Blood уже сыграло больше 10 миллионов', 'Издательство Warner Bros. Games и студия Turtle Rock анонсировали первое платное контентное расширение к кооперативному зомби-шутеру Back 4 Blood. Оно получило название Tunnels of Terror, а релиз его намечен на 12 апреля.\r\nС выходом обновления команды смогут отправиться в новую область Ridden Hives, где предстоит исследовать семь различных подземелий, населённых новым типом инфицированных. Среди них — устанавливающие наземные мины Urchins, чудовищные крошеры и наносящие урон потрошители. Их разновидности будут доступны и в PvP-режиме.\r\nРасширение добавит двух новых чистильщиков: пожарного Шарис и серьёзного ресторатора Хэна. Также в него входят восемь эксклюзивных скинов для персонажей, семь новых легендарных видов оружия, 12 новых скинов для оружия, новые карты и многое другое.\r\nОдновременно с выходом Tunnels of Terror появится бесплатное обновление No Hope, оно добавит дополнительный уровень сложности для элитных игроков. Весь игровой контент, включенный в дополнение «Туннели ужаса», будет доступен всем игрокам в группе, если хотя бы один из них купил расширение.\r\nЗаодно создатели игры объявили о новом рекорде Back 4 Blood. В зомби-шутер уже сыграло более десяти миллионов игроков. По данным The NPD Group игра стала «самой продаваемой новой интеллектуальной собственностью для консолей в 2021 году».', 'http://gamer.test/assets/img/news/news36.jpg', '2022-03-02 15:33:09'),
(37, 22, 'Свежий патч для Dota 2 обновил Dota Plus', 'Valve выпустила новое сезонное обновление Dota Plus. Оно добавило в игру весеннюю сокровищницу, часть функций из последнего боевого пропуска, сезонные задания и награды гильдии.\r\nИгроки, у которых есть Dota Plus, будут видеть не только таймер для отвода и стака крипов, но и индикатор появления рун. Он появится, если зажать клавишу Alt. Также геймеры будут получать подсказки по наиболее полезным нейтральным предметам для их героев.\r\nНаграды для гильдий включают новые смайлики, граффити и фразы для колеса чата. За выполнение заданий из нового сезонного набора можно получить 115 200 осколков — это общая сумма за все условия.\r\nЗа осколки можно открывать весеннюю сокровищницу. Она содержит наборы для Axe, Omniknight, Lion, Anti-Mage, Grimstroke, Kunkka, Death Prophet и Winter Wyvern. Также может выпасть редкий курьер Leafy the Seadragon с двумя случайными самоцветами: призматическим и кинетическим.', 'http://gamer.test/assets/img/news/news37.jpg', '2022-03-02 15:34:33'),
(38, 22, 'Журналисты оказались довольны Gran Turismo 7 — средний балл около 9 из 10', 'Сегодня спало эмбарго на публикации обзоров Gran Turismo 7, и критики высказались о готовящемся гоночном симуляторе. И если вкратце, у него всё хорошо: на момент публикации новости у неё 88 баллов на Opencritic (при этом 98% авторов рекомендуют игру) на основе 50 рецензий.<br />\r\nЖурналисты отмечают, что несмотря на некоторые огрехи, это достойный продукт Polyphony Digital, берущий лучшее из предыдущих частей серии. Отдельно выделяют приятные ощущения от вождения, погоду и звуковые эффекты. Особенно хорошо игра ощущается на PS5 с DualSense.<br />\r\n', 'http://gamer.test/assets/img/news/news38.jpg', '2022-03-02 15:40:27'),
(39, 22, 'Хидэтака Миядзаки: прощу прощения у тех, кто считает Elden Ring чересчур сложной', 'Казалось бы, все уже давно привыкли к тому, что в основе практически любой игры FromSoftware лежит превозмогание трудностям. И несмотря на то, что у такого геймдизайна куда больше поклонников, нежели недоброжелателей, геймдиректор Elden Ring решил извиниться перед всеми, кто посчитал его последний проект чересчур сложным.<br />\r\nСам Хидэтака Миядзаки хардкорным игроком себя не считает и даже заявил, что часто умирал в своих же собственных играх. И он хочет, чтобы игроки получали удовольствие, преодолевая сложности, анализируя свои ошибки и вновь возвращаясь на поле боя в надежде одолеть сурового босса.', 'http://gamer.test/assets/img/news/news39.jpg', '2022-03-02 15:41:12'),
(40, 22, 'Valve выпустила фикс, избавляющий Steam Deck от дрифта стиков', 'Дрифт стиков &mdash; распространённая проблема геймпадов, и особенно часто встречающаяся на консолях Nintendo Switch. Не обошла данная напасть и новенькую Steam Deck &mdash; на reddit хватает отзывов разочарованных покупателей.<br />\r\nКто-то даже снял видео, запустив тестовый режим &mdash; отчётливо видно, что консоль считает стик нажатым даже в момент, когда палец убран с него.<br />\r\nК счастью, проблема оказалась софтовой &mdash; Valve уже выпустила фикс, после установки которого проблема решится.<br />\r\nМы же напомним, что дрифт стиков далеко не всегда связан с браком &mdash; порой к нему приводит естественный износ. И чем активнее используется геймпад или портативная консоль, тем быстрее проблема даёт о себе знать.<br />\r\n', 'http://gamer.test/assets/img/news/news40.jpg', '2022-03-02 15:42:11'),
(41, 22, 'Humble Choice в марте: Mass Effect Legendary Edition и ещё 7 игр', 'Магазин Humble обнародовал ежемесячную подборку игр, которые станут доступны подписчикам Choice в марте. Напомним, что игры остаются в библиотеке навсегда, а цена вопроса &mdash; 699 рублей за все проекты из списка.<br />\r\nСамым ценным в наборе несомненно является сборник Mass Effect Legendary Edition, включающий в себя ремастеры трёх частей серии. В итоге получается, что по факту вы получите не восемь, а целых десять игр.', 'http://gamer.test/assets/img/news/news41.jpg', '2022-03-02 15:43:18'),
(42, 22, 'В Digital Foundry протестировали Elden Ring на PS5 и Xbox Series', 'На прошлой неделе Eurogamer выпустил статью, в которой статьи специалисты Digital Foundry выразили своё недовольство техническим состоянием Elden Ring.<br />\r\nЧуть позже на YouTube-канале вышел ролик, посвящённый ПК-версии, а теперь команда подробно отчиталась о том, как обстоят дела на консолях текущего поколения.<br />\r\nКак показали более детальные тесты, лучше всего играть на PS5 &mdash; на платформе Sony ролевой экшен грузится почти в три раза быстрее и отличается более стабильным фреймрейтом.<br />\r\nВпрочем, даже в режиме производительности частота кадров большую часть времени держится на отметке 40-50 FPS вместо заветных 60. При этом Elden Ring сильно сбавляет в качестве графики &mdash; разрешение падает с нативных 4K до динамических.<br />\r\nСреднее значение в режиме производительности составляет 1512p и при этом сильно ухудшается качество теней &mdash; следовательно, разница весьма ощутима. А знаете, что самое забавное? Версия, предоставленная в рамках ЗБТ, работала пусть и не сильно, но всё же стабильнее.<br />\r\nПоскольку даже в режиме качества Elden Ring стремится к 60 кадрам, Digital Foundry рекомендует играть именно так &mdash; стабильного фреймрейта всё равно не видать ни при каком раскладе. Если только не принести графику в жертву производительности и наслаждаться версией для PS4 по обратной совместимости.<br />\r\nК слову, этот же метод могут взять и на вооружение владельцы Xbox Series, но есть нюанс &mdash; из-за функции Smart Delivery запуск версии с прошлого поколения консолей возможен лишь без установки патча и, соответственно, при отключенном интернете. Поэтому о сетевых функциях можно забыть.<br />\r\nНапоследок отметим, что на Xbox Series S дела предсказуемо обстоят хуже всего &mdash; разрешение 2K, 30 FPS и совсем уж &laquo;пожатые&raquo; тени, которые проигрывают даже тем, что демонстрируют PS5 и Series X в режиме производительности.<br />\r\n', 'http://gamer.test/assets/img/news/news42.jpg', '2022-03-02 15:44:29'),
(43, 22, 'Состоялся релиз визуальной новеллы-приквела Ghostwire: Tokyo — на PS4 и PS5', 'Состоялся релиз Ghostwire: Tokyo – Prelude — бесплатной визуальной новеллы, которая является приквелом Ghostwire: Tokyo.<br />\r\nИгра доступна на PlayStation 4 и PlayStation 5, а на PC она появится только 8 марта. Над новеллой работала другая команда, а атмосфера в ней более спокойная.<br />\r\nGhostwire: Tokyo – Prelude даст почувствовать паранормальную сторону Токио и познакомит игроков с ключевыми персонажами истории.<br />\r\nСобытия новеллы происходят за шесть месяцев до Ghostwire: Tokyo. Главным героем стал Кей-Кей — детектив, расследующий таинственное происшествие. Вместе со своей командой он пытается найти пропавшего друга, но вместо этого натыкается на нечто более странное и зловещее.<br />\r\nНапомним, что в Ghostwire: Tokyo Кей-Кей также является одним из главных героев. Сам приключенческий хоррор выходит 25 марта на PS5 и PC. За предзаказ игроки получат стильный байкерский прикид и маску Хання.', 'http://gamer.test/assets/img/news/news43.jpg', '2022-03-02 15:45:10'),
(44, 22, 'Белорусская студия OldBit вынесла на Kickstarter ролевой боевик Meifumado', 'Маленькая независимая студия OldBit из Пинска в течение двух лет вела на собственные средства разработку олдскульного ролевого боевика Meifumado. Теперь же, когда у разработчиков готов прототип, продуманы все концепции и создана масса ассетов, студия собирается вывести разработку на новый уровень. И для этого нужны деньги.<br />\r\nС помощью Kickstarter создатели Meifumado планируют собрать 40 тысяч долларов. Пока что у них на счету &mdash; меньше двух тысяч, но до финала кампании остаётся 29 дней.', 'http://gamer.test/assets/img/news/news44.jpg', '2022-03-02 15:46:24');

-- --------------------------------------------------------

--
-- Структура таблицы `platforms`
--

CREATE TABLE `platforms` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `platforms`
--

INSERT INTO `platforms` (`id`, `name`) VALUES
(1, 'PC'),
(2, 'PS3'),
(3, 'PS4'),
(4, 'PS5'),
(5, 'Xbox 360'),
(6, 'Xbox One'),
(7, 'Xbox XS'),
(8, 'Wii U'),
(9, 'Nintendo Switch');

-- --------------------------------------------------------

--
-- Структура таблицы `reviews`
--

CREATE TABLE `reviews` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `game_id` int NOT NULL,
  `text` text COLLATE utf8mb4_general_ci NOT NULL,
  `rating` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `reviews`
--

INSERT INTO `reviews` (`id`, `author_id`, `game_id`, `text`, `rating`, `created_at`) VALUES
(2, 23, 6, 'Super', 9, '2022-02-09 13:06:44'),
(5, 22, 44, 'super', 10, '2022-02-09 13:53:24'),
(6, 23, 44, 'mega', 9, '2022-02-09 13:57:26'),
(13, 22, 54, 'thyjthhjthjtr<br />\r\njyhjyjyjy<br />\r\njymhjymujym', 9, '2022-02-26 16:30:30');

-- --------------------------------------------------------

--
-- Структура таблицы `short_news`
--

CREATE TABLE `short_news` (
  `id` int NOT NULL,
  `author_id` int NOT NULL,
  `text` varchar(256) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `short_news`
--

INSERT INTO `short_news` (`id`, `author_id`, `text`, `created_at`) VALUES
(6, 22, 'Теперь можно добавлять быстрые новости', '2022-02-17 13:32:48');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `nickname` varchar(128) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'http://gamer.test/assets/img/avatar/avatar.jpg',
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `role` enum('admin','user') COLLATE utf8mb4_general_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `auth_token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `nickname`, `email`, `date_of_birth`, `avatar`, `is_confirmed`, `role`, `password_hash`, `auth_token`, `created_at`) VALUES
(22, 'kan', 'koldun66622@gmail.com', '2016-02-22', 'http://gamer.test/assets/img/avatar/kan.jpg', 1, 'admin', '$2y$10$tE9bOR/VQSA5ZRNJxVgz4.ixkG2pUF4qaOlVorOCQfE6U/rCo4iMC', '8bfdf081712f6741c5fb4f93c2a42a1a31098cda638f1e4c9675ade6e3f635c1f389ef2cfb51df33', '2022-01-24 12:18:11');

-- --------------------------------------------------------

--
-- Структура таблицы `users_activation_codes`
--

CREATE TABLE `users_activation_codes` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `code` varchar(256) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `game`
--
ALTER TABLE `game`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `game_genres`
--
ALTER TABLE `game_genres`
  ADD PRIMARY KEY (`game_id`,`genres_id`),
  ADD KEY `fk_genre_id` (`genres_id`);

--
-- Индексы таблицы `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD PRIMARY KEY (`game_id`,`platforms_id`),
  ADD KEY `fk_platform_id` (`platforms_id`);

--
-- Индексы таблицы `genres`
--
ALTER TABLE `genres`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

--
-- Индексы таблицы `platforms`
--
ALTER TABLE `platforms`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `short_news`
--
ALTER TABLE `short_news`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nickname` (`nickname`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT для таблицы `game`
--
ALTER TABLE `game`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `genres`
--
ALTER TABLE `genres`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `news`
--
ALTER TABLE `news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT для таблицы `platforms`
--
ALTER TABLE `platforms`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `short_news`
--
ALTER TABLE `short_news`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT для таблицы `users_activation_codes`
--
ALTER TABLE `users_activation_codes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `game_genres`
--
ALTER TABLE `game_genres`
  ADD CONSTRAINT `fk_game_id` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `fk_genre_id` FOREIGN KEY (`genres_id`) REFERENCES `genres` (`id`);

--
-- Ограничения внешнего ключа таблицы `game_platforms`
--
ALTER TABLE `game_platforms`
  ADD CONSTRAINT `fk_game_platform_id` FOREIGN KEY (`game_id`) REFERENCES `game` (`id`),
  ADD CONSTRAINT `fk_platform_id` FOREIGN KEY (`platforms_id`) REFERENCES `platforms` (`id`);

--
-- Ограничения внешнего ключа таблицы `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
