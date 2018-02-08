-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 08 feb 2018 om 12:40
-- Serverversie: 10.1.19-MariaDB
-- PHP-versie: 5.6.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
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
  `firstname` varchar(64) NOT NULL,
  `lastname` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `auteurs`
--

INSERT INTO `auteurs` (`id`, `firstname`, `lastname`) VALUES
('1b9k16qhundw', 'Andy', 'Griffiths'),
('1uztr897cdhc', 'Paolo', 'Cognetti'),
('2du3g8dww2f8', 'Nora', 'Roberts'),
('2fiyfkl44zhn', 'Hasan', 'Aydin'),
('2mk1dvs06wkw', 'Timon', 'Schaars'),
('2q7db8dzg8uy', 'Sarah', 'Maas'),
('2v35bfyyxhwk', 'Dick', 'Bruna'),
('35xhxy5cpz8k', 'Stefan', 'Teunissen'),
('3etxttcrbukd', 'Lekker', 'Spelen'),
('3ik715vqqg4k', 'Jack', 'Thorne'),
('3qo40lnrvmec', 'Lonely', 'Planet'),
('3s39uf3v4vc4', 'Noelle', 'Smit'),
('3yick1h0yx99', 'Leon', 'Verdonschot'),
('402pjmrs142s', 'Michal', 'Janssen'),
('480gzhihu2kq', 'Britta', 'Teckentrup'),
('4muutminnfd', 'PIZZA', 'MAN'),
('4wlfq1batnk0', 'Disney', 'Pixar'),
('588f5c8y2f08', 'Peter', 'Schaars'),
('5mr9vqvqvjh3', 'Appel', 'Sap'),
('5xwtjfnct7sy', 'Frans', 'Bauer'),
('6eq4yo61dizs', 'Jan', 'Peter'),
('72gsaaw7n3jz', 'Terry', 'Goodkind'),
('7659bx63r5sd', 'Jamie', 'Oliver'),
('uwfpos8hqxc', 'Jochem', 'Myjer'),
('vx5vz4m0wmw', 'Jan', 'Smit');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `boeken`
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
-- Gegevens worden geëxporteerd voor tabel `boeken`
--

INSERT INTO `boeken` (`id`, `title`, `description`, `isbn13`, `auteurs`, `amount`) VALUES
('13pqvkt1gx81', 'Jamie Oliver 5 ingrediënten', 'Snel, simpel, superlekker - dé opvolger van Jamie in 15 minuten\r\n\r\nIn 5 ingrediënten: snel & simpel koken laat Jamie Oliver zien hoe je met slechts 5 ingrediënten elke dag heerlijk en healthy kunt eten. De recepten zijn stuk voor stuk eenvoudig te maken en in een handomdraai klaar. Het boek bevat 130 recepten over kip, rund-, varkens- en lamsvlees, vis, eieren, vegetarische recepten, salades, pasta''s, rijst, noedels en uiteraard heerlijke zoetigheden! Bij elk recept vind je een visuele ingrediëntenlijst, tijdsduur, portiegrootte, informatie over voedingswaarden en een gemakkelijk te volgen recept.\r\n\r\nDit is Jamie''s makkelijkste kookboek tot nu toe en ideaal voor mensen met weinig tijd. De nieuwe Jamie Oliver: elke dag verse maaltijden voor iedereen die tot vijf kan tellen.', 9789021566665, '7659bx63r5sd,', 2),
('2dehywtz0og0', 'Dikkertje Dap', '’s Morgens vroeg om kwart over zeven loopt Dikkertje Dap de dierentuin binnen. Met een trap, want hij gaat de giraffe een suikerklontje voeren. De giraf blijkt ontzettend aardig. Hij luistert naar alle verhalen van Dikkertje Dap en daarna mag Dikkertje van die heeeeel lange nek glijden.\r\n\r\nNoëlle Smit maakte van Annie M.G. Schmidts gedicht een prachtig prentenboek, zoals ze eerder met veel succes deed met ‘M’n opa’. Lezers van alle leeftijden zullen paf staan! ', 9789045121239, '3s39uf3v4vc4,', 50),
('2z6a63ei3qkg', 'Slaaplkets!', 'Slaapklets! is een dag- en nachtboek waarmee je voor het slapen gaan op een leuke manier even terugkijkt op de dag. Lekker slapen is belangrijk. Voor kinderen is het prettig om de dag rustig af te bouwen met een vast ritueel. Ook voor volwassenen is het goed om de dag te verwerken voor het slapen gaan. Op iedere pagina maak je korte notities over de dag. Wat was leuk, wat was stom? Was het een sportieve dag? Heb je zin in morgen? Onderaan iedere pagina staat een verrassende opdracht. Van ademhalingstips en ontspanningsoefeningen tot grappige vragen. Slaapklets! laat je kletsen over vandaag, vooruitkijken naar morgen, ontspannen en lekker slapen.', 9789081477970, '402pjmrs142s,', 60),
('3jcpxlb41uon', 'Ssst! De tijger slaapt', 'Ssst! De tijger slaapt'' is een verrassend en interactief prentenboek van Britta Teckentrup. Bijzonder is dat de ballonnen in de tekeningen glanzend zijn, zodat ze net op echte ballonnen lijken.\r\n\r\nDe tijger slaapt...\r\nSsst! De tijger slaapt en we willen haar niet wakker maken. Er is alleen een probleem: alle dieren moeten erlangs en ze ligt vreselijk in de weg. Hoe gaan ze dat oplossen? Gelukkig heeft de slimme kikker een idee: alle dieren zweven een voor een met een ballon over de tijger heen.\r\n\r\nDe lezer moet helpen\r\nMaar de dieren hebben wel hulp nodig. De lezer wordt dan ook aangemoedigd de dieren veilig over de tijger heen te krijgen door te blazen, te aaien, te wiegen en zelfs een slaapliedje te zingen. Zal het alle dieren lukken veilig aan de overkant te komen? En zeg, waar zijn al die ballonnen eigenlijk voor? ', 9789025765460, '480gzhihu2kq,', 10),
('3py2fxfnr7s4', 'Kleine pluis', 'Nijntje danst door het huis van blijdschap. Vader en moeder Pluis hebben haar net verteld dat ze een broertje of een zusje krijgt. Ze maakt vast een paar cadeaus. Als kleine Pluis geboren wordt, is Nijn er helemaal stil van, want ze had niet verwacht dat het zo klein zou zijn. De volgende dag trakteert ze de hele klas op beschuit met musjes.', 9789056470258, '2v35bfyyxhwk,', 50),
('442xh1ohp4ao', 'Gouden Boekjes - Olaf''s Frozen avontuur', 'Anna en Elsa geven een verrassingsfeest voor de hele stad. Maar als de dorpelingen zich onverwachts verontschuldigen om hun eigen feestjes voor te bereiden, realiseren Anna en Elsa zich dat ze geen eigen familietradities hebben. Olaf gaat, met Sven aan zijn zijde, op pad om de beste traditie ooit te vinden.', 9789047624172, '4wlfq1batnk0,', 50),
('4n7jd15h58ty', 'Rico', 'Schrijver Leon Verdonschot volgde de wereldkampioen kickboksen een jaar lang intensief. Tijdens trainingen, in voorbereiding naar wedstrijden, tijdens presentaties en workshops, thuis en in zijn vrije tijd. Hij sprak vele (jeugd)vrienden, familieleden, trainers, medesporters.\r\n\r\nHet resultaat is RICO: niet alleen een meeslepend en filmisch geschreven verhaal op de huid van de beste kickbokser ter wereld, maar ook een onthullend inkijk in het persoonlijke leven van Verhoeven. Voor het eerst vertelt hij (en zijn intimi) het verhaal van zijn getroebleerde jeugd. Zijn verstoorde relatie met zijn moeder, en de rol van zijn vader, die hem de eerste jaren trainde maar uiteindelijk buiten Verhoevens sportieve team belandde. Het legde de basis voor een zeer gecompliceerde band, die onlangs tragisch eindigde met het overlijden van Verhoevens vader.\r\nRICO is niet alleen een verhaal over sportieve wilskracht en discipline, maar ook een ontroerend verslag van een andere strijd: die om los te komen van je verleden. ', 9789048840410, '3yick1h0yx99,', 5),
('4pk3jxvxx1k4', 'Gouden Boekjes - Coco', 'Miguel droomt ervan om een succesvol muzikant te worden. Ondanks dat muziek verboden is in zijn familie, wil Miguel dolgraag net zo beroemd worden als zijn idool Ernesto de la Cruz. Op mysterieuze wijze komt Miguel op de Dag van de Doden in het kleurrijke Dodenrijk terecht. Daar ontmoet hij Hector en samen gaan ze op reis om het echte verhaal achter Miguels familiegeschiedenis te ontdekken. ', 9789047624523, '4wlfq1batnk0,', 50),
('5lqtziyc2u3d', 'De Kronieken van Nicci 1 - Maîtresse van de Dood', 'Maîtresse van de Dood is het eerste deel van Terry Goodkinds gloednieuwe trilogie De Kronieken van Nicci en is gebaseerd op een van de geliefdste personages uit zijn wereldwijde succesreeks De Wetten van de Magie en de daaropvolgende Richard & Kahlan-romans.\r\nOoit was ze luitenant in het leger van de verschrikkelijke Keizer Jagang en stond ze bekend als de Maîtresse van de Dood en de Slavenkoningin. De dodelijke Nicci wist zelfs Richard Rahl te vangen, en probeerde hem te overtuigen van de juistheid van de Imperiale Orde van Jagang.\r\nMaar het was Richard die Nicci bekeerde, en in de jaren die volgden diende ze Richard en Kahlan als een van hun dierbaarste vrienden – en een van hun dodelijkste beschermers.\r\nNu de heerschappij van Richard en Kahlan eindelijk is gestabiliseerd, trekt Nicci erop uit om haar eigen avonturen te beleven en de vrede van het D''Haraanse Rijk te verspreiden. Maar dan moet ze wel eerst de wereldvreemde profeet Nathan uit de problemen houden... ', 9789024578733, '72gsaaw7n3jz,', 5),
('5zbz0hpaen0g', 'De acht bergen', '\r\nPietro is een stadsjongen uit Milaan. Zijn vader is scheikundige, en gefrustreerd door zijn werk in een fabriek. Zijn ouders delen een liefde voor de bergen, dat is waar ze elkaar ontmoetten, waar ze verliefd werden en waar ze trouwden in een kerkje aan de voet van de berg. Door deze gedeelde passie kan hun relatie voortbestaan, zelfs wanneer tragische gebeurtenissen plaatsvinden. Het stadsleven vervult hun vaak met gevoelens van spijt dat ze niet voor een ander leven hebben gekozen. Dan ontdekken ze een dorpje in het Noord-Italiaanse Valle d''Aosta waar het gezin vanaf dat moment iedere zomer zal doorbrengen. De elfjarige Pietro raakt er bevriend met de even oude Bruno, die voor de koeien zorgt. Hun zomers vullen zich met eindeloze wandelingen door de bergen en zoektochten door verlaten huizen en oude molens en er bloeit een ogenschijnlijk onverwoestbare vriendschap op.', 9789023466413, '1uztr897cdhc,', 50),
('651lf3gnbqos', 'flapjesboek naar bed met nijntje', 'Het is bijna bedtijd voor nijntje. Wat doet ze voor het slapengaan? Eten, pyjama aan, tandenpoetsen en een boekje lezen. En dan: lekker slapen. Droom maar fijn, nijntje!\r\n\r\nEen vrolijk boek om je kind voor te bereiden op bedtijd; ook nijntje heeft een ritueel voor ze naar bed gaat. Kijk je mee? Op elke spread zit een makkelijk te openen flap, waardoor jonge lezertjes zelf de flapjes kunnen openmaken.', 9789056477554, '2v35bfyyxhwk,', 50),
('6b8imnvndzje', 'Cirkel 3 - De stille vallei', 'Het adembenemende laatste deel van de Cirkel-trilogie - liefde, romantiek, spanning en een vleugje magie\r\n\r\nDe cirkel die Liliths vampierleger moet verslaan, probeert het volk van Geall achter zich te krijgen. Als ervaren krijger én vrouw van adel speelt Moira daarin een belangrijke rol. En alsof die verantwoordelijkheid nog niet genoeg is, merkt ze dat ze vaker dan haar lief is denkt aan Cian. Maar hij is een vampier en staat aan de kant van de vijand…\r\n\r\nOm de man van wie ze houdt te overtuigen te kiezen voor het goede, heeft ze al haar intelligentie nodig, en een vleugje magie. Maar Lilith heeft zich eeuwenlang kunnen voorbereiden op dit gevecht en is niet van plan ook maar één krijger te laten gaan. De uitkomst van hun krachtmeting zal het lot van de mensheid voorgoed bepalen...', 9789022581889, '2du3g8dww2f8,,', 50),
('6jjfn4jr20v4', 'Glazen troon 5 - Rijk van stormen', 'Het vijfde deel in de populaire Glazen troon-serie neemt ons verder mee op Aelins epische reis en bouwt op naar een cliffhanger die iedereen zal doen smachten naar het vervolg.\r\n\r\n\r\n\r\nIn Rijk van stormen heeft Celaena allang haar rechtmatige rol van erfgename Aelin Galathynius ingenomen en heeft ze gezworen haar koninkrijk terug te krijgen. De Duistere Koning Erawan gebruikt Aelins verleden, haar vijanden en haar vrienden in een uiterste krachtvertoon om te voorkomen dat ze haar doel bereikt. Aelin heeft een krachtig hof dat ze leiding moet geven en heeft haar hart aan een Fae-prins gegeven. Nu moet ze bepalen wat – of wie – ze bereidt is op te offeren om haar wereld te redden…', 9789022580301, '2q7db8dzg8uy,', 5),
('i8erqwojbqg', 'Iceland', 'Lonely Planet Iceland is your passport to the most relevant, up-to-date advice on what to see and skip, and what hidden discoveries await you. Splash around in the Blue Lagoon''s geothermal water, catch a glimpse of the celestial Northern Lights, or take a boat trip among the icebergs; all with your trusted travel companion. Get to the heart of Iceland and begin your journey now!\r\n\r\nInside Lonely Planet''s Iceland Travel Guide:\r\n\r\n    Colour maps and images throughout Highlights and itineraries help you tailor your trip to your personal needs and interests Insider tips to save time and money and get around like a local, avoiding crowds and trouble spots Essential info at your fingertips - hours of operation, phone numbers, websites, transit tips, prices Honest reviews for all budgets - eating, sleeping, sight-seeing, going out, shopping, hidden gems that most guidebooks miss Cultural insights give you a richer, more rewarding travel experience - history, politics, landscapes, wildlife, literature, music, cinema, art, architecture, customs, cuisine. Free, convenient pull-out Reykjavik map (included in print version), plus over 37 maps Covers Reykjavik, the Westfjords, the Highlands, North Iceland, East Iceland, South Iceland, the Golden Circle, Southwest Iceland, the Eastfjords, Akureyri, Hunafloi and more \r\n\r\n\r\n\r\nThe Perfect Choice: Lonely Planet Iceland, our most comprehensive guide to Iceland, is perfect for both exploring top sights and taking roads less travelled.\r\n\r\n    Looking for a guide focused on Reykjavik? Check out Lonely Planet''s Pocket Reykjavik, a handy-sized guide focused on the can''t-miss sights for a quick trip. Looking for more extensive coverage? Check out Lonely Planet''s Scandinavia guide for a comprehensive look at all the region has to offer. \r\n\r\n\r\n\r\nAbout Lonely Planet: Since 1973, Lonely Planet has become the world''s leading travel media company with guidebooks to every destination, an award-winning website, mobile and digital travel products, and a dedicated traveller community. Lonely Planet covers must-see spots but also enables curious travellers to get off beaten paths to understand more of the culture of the places in which they find themselves. ', 9781786574718, '3qo40lnrvmec,', 50),
('iz9etevhehs', 'De Gorgels', 'Midden in de nacht wordt Melle wakker. Er zit een vreemd wezentje op de rand van zijn bed. Het lijkt wel een bolletje wol, met armpjes en beentjes en twee harige, puntige oren. Maar als Melle het licht aandoet, is het wezentje verdwenen. Als hij er op school over vertelt, lacht iedereen hem uit. Zelfs papa, die bioloog is, zegt dat het onzin is, dat zulke wezentjes niet bestaan. Maar Melle weet zeker wat hij gezien heeft…', 9789025867898, 'uwfpos8hqxc,', 50),
('ok3eji4il3osk2o', 'Mijn pure keuken', 'Als model heeft Pascale Naessens jarenlang een strijd gevoerd met haar eetgewoontes. Ze weigerde een leven te leiden waarbij ze calorieën moest tellen en niet meer kon genieten van koken en tafelen. En dus ging ze op zoek naar een andere manier van eten waarbij ze lekker en voldoende kon eten mét respect voor haar lichaam en lijn. Naar een manier die zowel het model, de levensgenieter als de romanticus in haar tevreden stelde. En haar echtgenoot Paul Jambers, want de liefde van de man gaat immers door de maag.\r\n\r\nPascale vond haar evenwicht in de pure keuken waar ze van kon genieten zonder schuldgevoel. De basis van deze keuken zijn goede combinaties, gezonde ingrediënten en de juiste vetten. De verrassing zit ''m in de eenvoud. Haar gerechten zijn speciaal en toch eenvoudig, ook om te bereiden. Al haar recepten en ondervindingen bundelde ze in haar eerste kookboek Mijn pure keuken. Een boek met veelal mediterraan geïnspireerde recepten op basis van vis, olijfolie, groenten en verse kruiden. En af en toe een stukje vlees voor de vitamine B12.\r\n\r\nAlle gerechten zijn samengesteld volgens een combinatiedieet: niemand zal er dus van verdikken en er zal eindelijk komaf gemaakt worden met dat opgeblazen gevoel.\r\nPascale en Paul kiezen bewust voor de pure keuken en laten de romantiek hoogtij vieren aan tafel.', 9789020926651, 'vx5vz4m0wmw,5mr9vqvqvjh3,5xwtjfnct7sy,35xhxy5cpz8k,', 6),
('ortg6he9pes', 'De waanzinnige boomhut 7 - De waanzinnige boomhut van 91 verdiepingen', 'Kom op bezoek bij Andy en Terry in hun waanzinnige, nog grotere boomhut! Draai rondjes in de krachtigste draaikolk ter wereld, maak een reisje met een onderzeebootbroodje, spoel aan op een onbewoond eiland, kom lekker in een reuzenspinnenweb hangen, stap de tent van een waarzegster binnen en laat je toekomst voorspellen door Mevrouw Weetallesal, en besluit of je wel of juist niet op de geheimzinnige grote rode knop zult drukken...\r\nDus waar wacht je op? Kom naar boven!\r\nBoordevol knotsgekke illustraties van de eerste tot de eenennegentigste verdieping. ', 9789401443111, '1b9k16qhundw,', 50),
('ozy8pn7kxlw', 'Harry Potter and the Cursed Child', 'Based on an original new story by J.K. Rowling, Jack Thorne and John Tiffany, a new play by Jack Thorne, Harry Potter and the Cursed Child is the eighth story in the Harry Potter series and the first official Harry Potter story to be presented on stage. The play will receive its world premiere in London''s West End on 30th July 2016.\r\n\r\nIt was always difficult being Harry Potter and it isn''t much easier now that he is an overworked employee of the Ministry of Magic, a husband, and father of three schoolage children. While Harry grapples with a past that refuses to stay where it belongs, his youngest son Albus must struggle with the weight of a family legacy he never wanted. As past and present fuse ominously, both father and son learn the uncomfortable truth: sometimes, darkness comes from unexpected places.', 9780751565355, '3ik715vqqg4k,', 50),
('q7utpyr94d4', 'Jamie Oliver''s kerstkookboek', 'Dit boek bevat dezelfde recepten als het Jamie Oliver''s Kerstkookboek van 2016 met de gele cover.\r\n\r\nJamie Oliver helpt je met Jamie Oliver''s Kerst Kookboek om deze feestdagen de lekkerste gerechten zonder stress op tafel te zetten. Want wat is er nu fijner dan tijdens het kerstfeest relaxed te kunnen genieten van een heerlijk kerstmenu? Jamies kerstkookboek zal je inspiratiebron én hulplijn zijn deze kerst. Het staat vol heerlijke recepten voor de feestdagen, van echte kerstklassiekers met een Jamie-twist tot vegetarische hoofdgerechten en gezonde traktaties. En natuurlijk ontbreken de recepten voor het kerstontbijt en de desserts niet. Jamies kerstkookboek zorgt ervoor dat je relaxed kunt genieten van de feestdagen!', 9789021567471, '7659bx63r5sd,', 5);

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
('47pp70unpncq', 'pieterpost420', 'Pieter', 'Post', '505a279d70b20e676e00f8e5677e311e60eb96281b34cad34e4e4d8ea78ca520', '6ff5646553f8246b', 'pieter@post.nl', 0),
('5yyp6r1u0gce', 'janjanssen6969', 'Jan', 'Janssen', 'b307293979800fb5d41be12d77173a0351401070272d48480df7c2328dd0779b', '7004f0f32c88a10e', 'jan@janssen.nl', 0),
('9fme6qy1yzn', 'appelsap69', 'Appel', 'Sap', 'f969675843e7bcbd494d2b72145230515f161b0962de2ecd5c9e71142dbe3ab3', '228df49258e16fbf', 'appel@sap.nl', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `uitgeleend`
--

CREATE TABLE `uitgeleend` (
  `id` varchar(15) NOT NULL,
  `bookid` varchar(15) NOT NULL,
  `userid` varchar(15) NOT NULL,
  `borrowed` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `auteurs`
--
ALTER TABLE `auteurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `boeken`
--
ALTER TABLE `boeken`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `uitgeleend`
--
ALTER TABLE `uitgeleend`
  ADD PRIMARY KEY (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
