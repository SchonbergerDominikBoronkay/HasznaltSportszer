-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Ápr 07. 14:21
-- Kiszolgáló verziója: 10.4.6-MariaDB
-- PHP verzió: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `sportszer_ab`
--
CREATE DATABASE IF NOT EXISTS `sportszer_ab` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `sportszer_ab`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `name` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `allapotok`
--

CREATE TABLE `allapotok` (
  `allapotok_id` int(4) NOT NULL,
  `allapotok_megn` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `allapotok`
--

INSERT INTO `allapotok` (`allapotok_id`, `allapotok_megn`) VALUES
(1, 'új'),
(2, 'újszerű'),
(3, 'használt'),
(4, 'megkímélt'),
(5, 'sérült');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `hir_id` int(100) NOT NULL,
  `marka` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `ar` int(10) NOT NULL,
  `termektipus` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kep1` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `felhasznalo`
--

CREATE TABLE `felhasznalo` (
  `id` int(4) NOT NULL,
  `name` varchar(30) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `number` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_hungarian_ci NOT NULL,
  `address` varchar(300) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `hirdetesek`
--

CREATE TABLE `hirdetesek` (
  `id` int(11) NOT NULL,
  `allapotok_id` int(11) NOT NULL,
  `markak_id` int(11) NOT NULL,
  `nemek_id` int(11) NOT NULL,
  `sportagak_id` int(11) NOT NULL,
  `szinek_id` int(11) NOT NULL,
  `tipusok_id` int(11) NOT NULL,
  `ar` int(11) NOT NULL,
  `leiras` varchar(500) COLLATE utf8_hungarian_ci NOT NULL,
  `telszam` varchar(40) COLLATE utf8_hungarian_ci NOT NULL,
  `kep1` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kep2` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kep3` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kep4` varchar(100) COLLATE utf8_hungarian_ci NOT NULL,
  `kep5` varchar(100) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `markak`
--

CREATE TABLE `markak` (
  `markak_id` int(6) NOT NULL,
  `markak_megn` varchar(40) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `markak`
--

INSERT INTO `markak` (`markak_id`, `markak_megn`) VALUES
(1, 'Egyéb'),
(2, 'Adidas'),
(3, 'Ars una'),
(4, 'Asics'),
(5, 'Babolat'),
(6, 'Belmanetti'),
(7, 'Blink'),
(8, 'BP'),
(9, 'Broadway'),
(10, 'Chevelle'),
(11, 'Columbia'),
(12, 'Converse'),
(13, 'Crocs'),
(14, 'Dc'),
(15, 'Dorko'),
(16, 'Effea'),
(17, 'EmporioArmani'),
(18, 'Enzo'),
(19, 'Fila'),
(20, 'Gant'),
(21, 'Gas'),
(22, 'Get & Go'),
(23, 'Getback'),
(24, 'Gola'),
(25, 'Helly Hansen'),
(26, 'Hummel'),
(27, 'Jeff'),
(28, 'Kensho'),
(29, 'Lancast'),
(30, 'LeCoq Sportif'),
(31, 'Levis'),
(32, 'Maruti'),
(33, 'Mexx'),
(34, 'Mission'),
(35, 'New Balance'),
(36, 'Nike'),
(37, 'Norah'),
(38, 'ONeill'),
(39, 'Oxbow'),
(40, 'Puma'),
(41, 'Quiksilver'),
(42, 'Reebok'),
(43, 'Rio Grande'),
(44, 'Rossignol'),
(45, 'Roxy'),
(46, 'Salomon'),
(47, 'Saucony'),
(48, 'Sealand'),
(49, 'Slazenger'),
(50, 'Smithy'),
(51, 'Speedo'),
(52, 'Tommy Hilfiger'),
(53, 'Umbro'),
(54, 'UsPoloAssn'),
(55, 'Vans'),
(56, 'Wilson'),
(57, 'Yonex');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `nemek`
--

CREATE TABLE `nemek` (
  `nemek_id` int(4) NOT NULL,
  `nemek_megn` varchar(50) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `nemek`
--

INSERT INTO `nemek` (`nemek_id`, `nemek_megn`) VALUES
(1, 'férfi'),
(2, 'női'),
(3, 'unisex');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `rendelesek`
--

CREATE TABLE `rendelesek` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `nev` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `telszam` varchar(20) COLLATE utf8_hungarian_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `modszer` varchar(50) COLLATE utf8_hungarian_ci NOT NULL,
  `cim` varchar(500) COLLATE utf8_hungarian_ci NOT NULL,
  `ossz_rendeles` varchar(1000) COLLATE utf8_hungarian_ci NOT NULL,
  `ossz_ar` int(100) NOT NULL,
  `datum` date NOT NULL DEFAULT current_timestamp(),
  `fizetes` varchar(30) COLLATE utf8_hungarian_ci NOT NULL DEFAULT 'fizetés nem történt meg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `sportagak`
--

CREATE TABLE `sportagak` (
  `sportagak_id` int(6) NOT NULL,
  `sportagak_megn` varchar(60) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `sportagak`
--

INSERT INTO `sportagak` (`sportagak_id`, `sportagak_megn`) VALUES
(1, 'akrobatikus rock and roll'),
(2, 'AcroCap'),
(3, 'aerobik'),
(4, 'aikidó'),
(5, 'alpinizmus'),
(6, 'amerikai futball'),
(7, 'angol biliárd'),
(8, 'asztalifoci'),
(9, 'asztalitenisz'),
(10, 'atlétika'),
(11, 'ausztrál futball'),
(12, 'backgammon'),
(13, 'ballonozás'),
(14, 'baseball'),
(15, 'biatlon'),
(16, 'birkózás'),
(17, 'bob'),
(18, 'bowling'),
(19, 'bridzs'),
(20, 'búvárkodás'),
(21, 'curling'),
(22, 'cselgáncs'),
(23, 'darts'),
(24, 'diszkoszvetés'),
(25, 'díjlovaglás'),
(26, 'díjugratás'),
(27, 'ejtőernyőzés'),
(28, 'erőemelés'),
(29, 'erősember-sport'),
(30, 'e-sport'),
(31, 'evezés'),
(32, 'fallabda'),
(33, 'falmászás'),
(34, 'fitnesz'),
(35, 'fives'),
(36, 'floorball'),
(37, 'fogathajtás'),
(38, 'footbag'),
(39, 'Formula–1'),
(40, 'Formula–2'),
(41, 'Formula–3'),
(42, 'futás'),
(43, 'futsal'),
(44, 'gael futball'),
(45, 'gerelyhajítás'),
(46, 'go'),
(47, 'gokart'),
(48, 'golf'),
(49, 'golyósport'),
(50, 'gördeszka'),
(51, 'görkorcsolya'),
(52, 'gumiasztal'),
(53, 'gyaloglás'),
(54, 'gyeplabda'),
(55, 'gyepteke'),
(56, 'gyorskorcsolya'),
(57, 'hármasugrás'),
(58, 'hegyi-kerékpár'),
(59, 'hegymászás'),
(60, 'horgászat'),
(61, 'hódeszka'),
(62, 'hurling'),
(63, 'indiaca'),
(64, 'íjászat'),
(65, 'jégkorong'),
(66, 'jégmotorozás'),
(67, 'jégtánc'),
(68, 'jégvitorlázás'),
(69, 'ju-jitsu'),
(70, 'kajak-kenu'),
(71, 'kajakpóló'),
(72, 'kalapácsvetés'),
(73, 'kanadai futball'),
(74, 'kangoo jumps'),
(75, 'karate'),
(76, 'kempo'),
(77, 'kendó'),
(78, 'kerekesszékes rögbi'),
(79, 'kerékpár'),
(80, 'kézilabda'),
(81, 'kick-box'),
(82, 'korfball'),
(83, 'kosárlabda'),
(84, 'krikett'),
(85, 'krokett'),
(86, 'kungfu'),
(87, 'labdarúgás'),
(88, 'lacrosse'),
(89, 'ligarögbi'),
(90, 'lovaglás'),
(91, 'lovasíjászat'),
(92, 'lovaspóló'),
(93, 'lovas torna'),
(94, 'lovastusa'),
(95, 'lövészet'),
(96, 'magasugrás'),
(97, 'méta'),
(98, 'motokrossz'),
(99, 'motorcsónaksport'),
(100, 'motorkerékpársport'),
(101, 'motoros sárkányrepülés'),
(102, 'műkorcsolya'),
(103, 'műrepülés'),
(104, 'műugrás és toronyugrás'),
(105, 'nanbudo'),
(106, 'netball'),
(107, 'nihon tai jitsu'),
(108, 'Országútikerékpár-versenyzés'),
(109, 'ökölvívás'),
(110, 'öttusa'),
(111, 'paintball'),
(112, 'patkódobás'),
(113, 'pálya-kerékpározás'),
(114, 'pelota'),
(115, 'pétanque'),
(116, 'piramid biliárd'),
(117, 'pool'),
(118, 'póker'),
(119, 'racket'),
(120, 'racket ball'),
(121, 'rafting'),
(122, 'rali'),
(123, 'rádióamatőr sportok'),
(124, 'repülőverseny'),
(125, 'ritmikus gimnasztika'),
(126, 'rögbi'),
(127, 'röplabda'),
(128, 'rúdfitness'),
(129, 'rundolás'),
(130, 'rúdugrás'),
(131, 'sakk'),
(132, 'sárkányrepülés'),
(133, 'shinty'),
(134, 'siklórepülés'),
(135, 'síbobverseny'),
(136, 'síelés'),
(137, 'sítájfutás'),
(138, 'síugrás'),
(139, 'skittle'),
(140, 'snooker'),
(141, 'snowboard'),
(142, 'softball'),
(143, 'speedball'),
(144, 'sporttánc'),
(145, 'strandröplabda'),
(146, 'street workout'),
(147, 'superbike'),
(148, 'súlyemelés'),
(149, 'súlylökés'),
(150, 'szambó'),
(151, 'szánkósport'),
(152, 'sziklamászás'),
(153, 'szinkronúszás'),
(154, 'szkander'),
(155, 'szörf'),
(156, 'szörfvitorlázás'),
(157, 'szumó'),
(158, 'taekwondo'),
(159, 'tájékozódási túraverseny'),
(160, 'tájfutás'),
(161, 'távolugrás'),
(162, 'teke'),
(163, 'tenisz'),
(164, 'teremlabdarúgás'),
(165, 'testépítés'),
(166, 'tollaslabda'),
(167, 'torna (sportág)'),
(168, 'többpróba'),
(169, 'trambulin (gumiasztal)-ugrás'),
(170, 'traplövészet'),
(171, 'trekking'),
(172, 'triatlon'),
(173, 'Turán-Jitsu'),
(174, 'túrakocsi'),
(175, 'ulama'),
(176, 'ultimate'),
(177, 'ultramaraton'),
(178, 'úszás'),
(179, 'vadászat'),
(180, 'vitorlázás'),
(181, 'vitorlázórepülés'),
(182, 'vívás'),
(183, 'víz alatti rögbi'),
(184, 'vízihoki'),
(185, 'vízikosárlabda'),
(186, 'vízilabda'),
(187, 'wakeboard'),
(188, 'water skyball');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szinek`
--

CREATE TABLE `szinek` (
  `szinek_id` int(4) NOT NULL,
  `szinek_megn` varchar(20) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `szinek`
--

INSERT INTO `szinek` (`szinek_id`, `szinek_megn`) VALUES
(1, 'barna'),
(2, 'fehér'),
(3, 'fekete'),
(4, 'kék'),
(5, 'lila'),
(6, 'narancssárga'),
(7, 'piros'),
(8, 'sárga'),
(9, 'szürke'),
(10, 'zöld');

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `tipusok`
--

CREATE TABLE `tipusok` (
  `tipusok_id` int(6) NOT NULL,
  `tipusok_megn` varchar(40) COLLATE utf8_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `tipusok`
--

INSERT INTO `tipusok` (`tipusok_id`, `tipusok_megn`) VALUES
(1, 'aláöltözetek'),
(2, 'cipő'),
(3, 'kiegészítők'),
(4, 'melegítő alsó'),
(5, 'melegítő felső'),
(6, 'póló'),
(7, 'rövidnadrág'),
(8, 'sapka'),
(9, 'zokni');

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `allapotok`
--
ALTER TABLE `allapotok`
  ADD PRIMARY KEY (`allapotok_id`);

--
-- A tábla indexei `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `felhasznalo`
--
ALTER TABLE `felhasznalo`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `hirdetesek`
--
ALTER TABLE `hirdetesek`
  ADD PRIMARY KEY (`id`),
  ADD KEY `allapot` (`allapotok_id`),
  ADD KEY `markak_id` (`markak_id`),
  ADD KEY `nem` (`nemek_id`),
  ADD KEY `sportagak_id` (`sportagak_id`),
  ADD KEY `tipusok_id` (`tipusok_id`),
  ADD KEY `szinek_id` (`szinek_id`);

--
-- A tábla indexei `markak`
--
ALTER TABLE `markak`
  ADD PRIMARY KEY (`markak_id`);

--
-- A tábla indexei `nemek`
--
ALTER TABLE `nemek`
  ADD PRIMARY KEY (`nemek_id`);

--
-- A tábla indexei `rendelesek`
--
ALTER TABLE `rendelesek`
  ADD PRIMARY KEY (`id`);

--
-- A tábla indexei `sportagak`
--
ALTER TABLE `sportagak`
  ADD PRIMARY KEY (`sportagak_id`);

--
-- A tábla indexei `szinek`
--
ALTER TABLE `szinek`
  ADD PRIMARY KEY (`szinek_id`);

--
-- A tábla indexei `tipusok`
--
ALTER TABLE `tipusok`
  ADD PRIMARY KEY (`tipusok_id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT a táblához `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT a táblához `felhasznalo`
--
ALTER TABLE `felhasznalo`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT a táblához `hirdetesek`
--
ALTER TABLE `hirdetesek`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT a táblához `rendelesek`
--
ALTER TABLE `rendelesek`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT a táblához `sportagak`
--
ALTER TABLE `sportagak`
  MODIFY `sportagak_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=189;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `hirdetesek`
--
ALTER TABLE `hirdetesek`
  ADD CONSTRAINT `hirdetesek_ibfk_1` FOREIGN KEY (`allapotok_id`) REFERENCES `allapotok` (`allapotok_id`),
  ADD CONSTRAINT `hirdetesek_ibfk_2` FOREIGN KEY (`sportagak_id`) REFERENCES `sportagak` (`sportagak_id`),
  ADD CONSTRAINT `hirdetesek_ibfk_3` FOREIGN KEY (`tipusok_id`) REFERENCES `tipusok` (`tipusok_id`),
  ADD CONSTRAINT `hirdetesek_ibfk_4` FOREIGN KEY (`szinek_id`) REFERENCES `szinek` (`szinek_id`),
  ADD CONSTRAINT `hirdetesek_ibfk_5` FOREIGN KEY (`nemek_id`) REFERENCES `nemek` (`nemek_id`),
  ADD CONSTRAINT `hirdetesek_ibfk_6` FOREIGN KEY (`markak_id`) REFERENCES `markak` (`markak_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
