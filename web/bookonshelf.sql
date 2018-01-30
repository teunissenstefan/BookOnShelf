-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2018 at 04:22 PM
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
('2du3g8dww2f8', 'Nora', 'Roberts'),
('2fiyfkl44zhn', 'Hasan', 'Aydin'),
('2mk1dvs06wkw', 'Timon', 'Schaars'),
('2q7db8dzg8uy', 'Sarah', 'Maas'),
('35xhxy5cpz8k', 'Stefan', 'Teunissen'),
('3etxttcrbukd', 'Lekker', 'Spelen'),
('588f5c8y2f08', 'Peter', 'Schaars'),
('5kkfzp97vuqk', 'Naomi', 'Alderman'),
('5mr9vqvqvjh3', 'Appel', 'Sap'),
('5xwtjfnct7sy', 'Frans', 'Bauer'),
('6eq4yo61dizs', 'Jan', 'Peter'),
('72gsaaw7n3jz', 'Terry', 'Goodkind'),
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
('5lqtziyc2u3d', 'De Kronieken van Nicci 1 - Maîtresse van de Dood', 'Maîtresse van de Dood is het eerste deel van Terry Goodkinds gloednieuwe trilogie De Kronieken van Nicci en is gebaseerd op een van de geliefdste personages uit zijn wereldwijde succesreeks De Wetten van de Magie en de daaropvolgende Richard & Kahlan-romans.\r\nOoit was ze luitenant in het leger van de verschrikkelijke Keizer Jagang en stond ze bekend als de Maîtresse van de Dood en de Slavenkoningin. De dodelijke Nicci wist zelfs Richard Rahl te vangen, en probeerde hem te overtuigen van de juistheid van de Imperiale Orde van Jagang.\r\nMaar het was Richard die Nicci bekeerde, en in de jaren die volgden diende ze Richard en Kahlan als een van hun dierbaarste vrienden – en een van hun dodelijkste beschermers.\r\nNu de heerschappij van Richard en Kahlan eindelijk is gestabiliseerd, trekt Nicci erop uit om haar eigen avonturen te beleven en de vrede van het D\'Haraanse Rijk te verspreiden. Maar dan moet ze wel eerst de wereldvreemde profeet Nathan uit de problemen houden... ', 9789024578733, '72gsaaw7n3jz,', 5),
('621ryuwnhkev', 'De Macht', 'In \"De macht\' van Naomi Alderman ontdekken vrouwen overal ter wereld dat zij de kracht bezitten. Met de minste vingerbeweging kunnen ze folterende pijnen veroorzaken, en zelfs doden. Ineens beseft iedere man op aarde dat hij de macht niet meer in handen heeft.\r\nDe Dag van de Meisjes is aangebroken – maar waar houdt het op?\r\n\"Een grote, onweerstaanbare en wereldomvattende thriller.\' – \"The Guardian\'\r\n\"Onweerstaanbaar. Een spiegel voor het hier en nu.\' – \"Mail on Sunday\'\r\n\"Een fascinerende kijk op hoe de wereld zou kunnen zijn als na duizenden jaren van seksisme de rollen werden omgedraaid. Ingenieus… verdient het om door iedere vrouw gelezen te worden (en trouwens ook door iedere man).\' – \"The Times\'', 9789025451875, '5kkfzp97vuqk,', 1),
('6b8imnvndzje', 'Cirkel 3 - De stille vallei', 'Het adembenemende laatste deel van de Cirkel-trilogie - liefde, romantiek, spanning en een vleugje magie\r\n\r\nDe cirkel die Liliths vampierleger moet verslaan, probeert het volk van Geall achter zich te krijgen. Als ervaren krijger én vrouw van adel speelt Moira daarin een belangrijke rol. En alsof die verantwoordelijkheid nog niet genoeg is, merkt ze dat ze vaker dan haar lief is denkt aan Cian. Maar hij is een vampier en staat aan de kant van de vijand…\r\n\r\nOm de man van wie ze houdt te overtuigen te kiezen voor het goede, heeft ze al haar intelligentie nodig, en een vleugje magie. Maar Lilith heeft zich eeuwenlang kunnen voorbereiden op dit gevecht en is niet van plan ook maar één krijger te laten gaan. De uitkomst van hun krachtmeting zal het lot van de mensheid voorgoed bepalen...', 9789022581889, '2du3g8dww2f8,', 50),
('6jjfn4jr20v4', 'Glazen troon 5 - Rijk van stormen', 'Het vijfde deel in de populaire Glazen troon-serie neemt ons verder mee op Aelins epische reis en bouwt op naar een cliffhanger die iedereen zal doen smachten naar het vervolg.\r\n\r\n\r\n\r\nIn Rijk van stormen heeft Celaena allang haar rechtmatige rol van erfgename Aelin Galathynius ingenomen en heeft ze gezworen haar koninkrijk terug te krijgen. De Duistere Koning Erawan gebruikt Aelins verleden, haar vijanden en haar vrienden in een uiterste krachtvertoon om te voorkomen dat ze haar doel bereikt. Aelin heeft een krachtig hof dat ze leiding moet geven en heeft haar hart aan een Fae-prins gegeven. Nu moet ze bepalen wat – of wie – ze bereidt is op te offeren om haar wereld te redden…', 9789022580301, '2q7db8dzg8uy,', 5),
('ok3eji4il3osk2o', 'Mijn pure keuken', 'Als model heeft Pascale Naessens jarenlang een strijd gevoerd met haar eetgewoontes. Ze weigerde een leven te leiden waarbij ze calorieën moest tellen en niet meer kon genieten van koken en tafelen. En dus ging ze op zoek naar een andere manier van eten waarbij ze lekker en voldoende kon eten mét respect voor haar lichaam en lijn. Naar een manier die zowel het model, de levensgenieter als de romanticus in haar tevreden stelde. En haar echtgenoot Paul Jambers, want de liefde van de man gaat immers door de maag.\r\n\r\nPascale vond haar evenwicht in de pure keuken waar ze van kon genieten zonder schuldgevoel. De basis van deze keuken zijn goede combinaties, gezonde ingrediënten en de juiste vetten. De verrassing zit \'m in de eenvoud. Haar gerechten zijn speciaal en toch eenvoudig, ook om te bereiden. Al haar recepten en ondervindingen bundelde ze in haar eerste kookboek Mijn pure keuken. Een boek met veelal mediterraan geïnspireerde recepten op basis van vis, olijfolie, groenten en verse kruiden. En af en toe een stukje vlees voor de vitamine B12.\r\n\r\nAlle gerechten zijn samengesteld volgens een combinatiedieet: niemand zal er dus van verdikken en er zal eindelijk komaf gemaakt worden met dat opgeblazen gevoel.\r\nPascale en Paul kiezen bewust voor de pure keuken en laten de romantiek hoogtij vieren aan tafel.', 9789020926651, 'vx5vz4m0wmw,5mr9vqvqvjh3,5xwtjfnct7sy,35xhxy5cpz8k,', 6);

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
