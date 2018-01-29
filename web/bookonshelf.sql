-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 29, 2018 at 03:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.1

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
-- Table structure for table `auteurs`
--

CREATE TABLE `auteurs` (
  `id` varchar(15) NOT NULL,
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auteurs`
--

INSERT INTO `auteurs` (`id`, `firstname`, `lastname`) VALUES
('2fiyfkl44zhn', 'Hasan', 'Aydin'),
('2mk1dvs06wkw', 'Timon', 'Schaars'),
('3etxttcrbukd', 'Lekker', 'Spelen'),
('588f5c8y2f08', 'Peter', 'Schaars'),
('5mr9vqvqvjh3', 'Appel', 'Sap'),
('5xwtjfnct7sy', 'Frans', 'Bauer'),
('6eq4yo61dizs', 'Jan', 'Peter'),
('vx5vz4m0wmw', 'Jan', 'Smit');

-- --------------------------------------------------------

--
-- Table structure for table `boeken`
--

CREATE TABLE `boeken` (
  `id` varchar(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `isbn13` bigint(13) NOT NULL,
  `auteurs` text NOT NULL,
  `amount` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `boeken`
--

INSERT INTO `boeken` (`id`, `title`, `description`, `isbn13`, `auteurs`, `amount`) VALUES
('ok3eji4il3osk2o', 'Mijn pure keuken', 'Als model heeft Pascale Naessens jarenlang een strijd gevoerd met haar eetgewoontes. Ze weigerde een leven te leiden waarbij ze calorieën moest tellen en niet meer kon genieten van koken en tafelen. En dus ging ze op zoek naar een andere manier van eten waarbij ze lekker en voldoende kon eten mét respect voor haar lichaam en lijn. Naar een manier die zowel het model, de levensgenieter als de romanticus in haar tevreden stelde. En haar echtgenoot Paul Jambers, want de liefde van de man gaat immers door de maag.\r\n\r\nPascale vond haar evenwicht in de pure keuken waar ze van kon genieten zonder schuldgevoel. De basis van deze keuken zijn goede combinaties, gezonde ingrediënten en de juiste vetten. De verrassing zit \'m in de eenvoud. Haar gerechten zijn speciaal en toch eenvoudig, ook om te bereiden. Al haar recepten en ondervindingen bundelde ze in haar eerste kookboek Mijn pure keuken. Een boek met veelal mediterraan geïnspireerde recepten op basis van vis, olijfolie, groenten en verse kruiden. En af en toe een stukje vlees voor de vitamine B12.\r\n\r\nAlle gerechten zijn samengesteld volgens een combinatiedieet: niemand zal er dus van verdikken en er zal eindelijk komaf gemaakt worden met dat opgeblazen gevoel.\r\nPascale en Paul kiezen bewust voor de pure keuken en laten de romantiek hoogtij vieren aan tafel.', 9789020926651, 'vx5vz4m0wmw,5mr9vqvqvjh3,5xwtjfnct7sy,', 6);

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
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
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `username`, `firstname`, `lastname`, `password`, `salt`, `email`, `rank`) VALUES
('47pp70unpncq', 'pieterpost420', 'Pieter', 'Post', '505a279d70b20e676e00f8e5677e311e60eb96281b34cad34e4e4d8ea78ca520', '6ff5646553f8246b', 'pieter@post.nl', 0),
('5yyp6r1u0gce', 'janjanssen6969', 'Jan', 'Janssen', 'b307293979800fb5d41be12d77173a0351401070272d48480df7c2328dd0779b', '7004f0f32c88a10e', 'jan@janssen.nl', 0),
('9fme6qy1yzn', 'appelsap69', 'Appel', 'Sap', 'f969675843e7bcbd494d2b72145230515f161b0962de2ecd5c9e71142dbe3ab3', '228df49258e16fbf', 'appel@sap.nl', 0);

-- --------------------------------------------------------

--
-- Table structure for table `uitgeleend`
--

CREATE TABLE `uitgeleend` (
  `id` varchar(15) NOT NULL,
  `bookid` varchar(15) NOT NULL,
  `userid` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `uitgeleend`
--

INSERT INTO `uitgeleend` (`id`, `bookid`, `userid`) VALUES
('ok3eji4il3osk20', 'ok3eji4il3osk2o', '5yyp6r1u0gce'),
('ok3eji4il3osk2o', 'ok3eji4il3osk2o', '47pp70unpncq');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `boeken`
--
ALTER TABLE `boeken`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uitgeleend`
--
ALTER TABLE `uitgeleend`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
