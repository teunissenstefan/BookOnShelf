-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 22 jan 2018 om 15:17
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
  `isbn13` int(13) NOT NULL,
  `auteursid` varchar(15) NOT NULL,
  `takenby` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
