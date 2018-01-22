-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 jan 2018 om 15:31
-- Serverversie: 10.1.26-MariaDB
-- PHP-versie: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bookonshelf`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `auteurs`
--

CREATE TABLE `auteurs` (
  `id` varchar(15) NOT NULL,
  `name` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeken`
--

CREATE TABLE `boeken` (
  `id` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `isbn13` bigint(13) NOT NULL,
  `auteursid` varchar(15) NOT NULL,
  `takenby` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `boeken`
--

INSERT INTO `boeken` (`id`, `title`, `description`, `isbn13`, `auteursid`, `takenby`) VALUES
('ok3eji4il3osk2o', 'Mijn pure keuken', 'Als model heeft Pascale Naessens jarenlang een strijd gevoerd met haar eetgewoontes. Ze weigerde een leven te leiden waarbij ze calorieën moest tellen en niet meer kon genieten van koken en tafelen. En dus ging ze op zoek naar een andere manier van eten waarbij ze lekker en voldoende kon eten mét respect voor haar lichaam en lijn. Naar een manier die zowel het model, de levensgenieter als de romanticus in haar tevreden stelde. En haar echtgenoot Paul Jambers, want de liefde van de man gaat immers door de maag.\r\n\r\nPascale vond haar evenwicht in de pure keuken waar ze van kon genieten zonder schuldgevoel. De basis van deze keuken zijn goede combinaties, gezonde ingrediënten en de juiste vetten. De verrassing zit \'m in de eenvoud. Haar gerechten zijn speciaal en toch eenvoudig, ook om te bereiden. Al haar recepten en ondervindingen bundelde ze in haar eerste kookboek Mijn pure keuken. Een boek met veelal mediterraan geïnspireerde recepten op basis van vis, olijfolie, groenten en verse kruiden. En af en toe een stukje vlees voor de vitamine B12.\r\n\r\nAlle gerechten zijn samengesteld volgens een combinatiedieet: niemand zal er dus van verdikken en er zal eindelijk komaf gemaakt worden met dat opgeblazen gevoel.\r\nPascale en Paul kiezen bewust voor de pure keuken en laten de romantiek hoogtij vieren aan tafel.', 9789020926651, '0', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` varchar(15) NOT NULL,
  `username` varchar(255) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL,
  `password` char(64) NOT NULL,
  `salt` char(16) NOT NULL,
  `email` varchar(255) NOT NULL,
  `rank` int(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `username`, `firstname`, `lastname`, `password`, `salt`, `email`, `rank`) VALUES
('4gqn2myizvok', 'teunissenstefan', 'Stefan', 'Teunissen', '7b1606530f805a3bd6d8ce741ccb504e810d048d306824f9b29f18f84645f59e', '18d56de61e173783', 'stefanteunissen1@gmail.com', 1),
('asdsad', 'sadsadsad', 'sdasdasda', 'dasdsadsa', 'dsadasd', 'asdasdasd', 'asdsadas', 1),
('dasdsa', 'dsadsad', 'sadsa', 'dasd', 'asdadas', 'dsadsadsadsa', 'dsadsa', 0),
('dfdsfds', 'fdsfdsfds', 'fdsfds', 'fdsfds', 'fdsfdsf', 'dsfdsfds', 'fds', 0),
('dsadsad', 'asdadsa', 'sadsadsa', 'dsadsa', 'dasds', 'adsadsa', 'dsadsa', 0),
('sdsadasd', 'sadasdsad', 'asdasd', 'asdsadsa', 'dsadas', 'dsads', 'adasda', 0);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
